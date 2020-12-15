<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\ProjectAndTicketNotification;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Ticket::class);

        $tickets = Ticket::all();

        return view('tickets.index', compact('tickets'));
    }

    /*
     * Show the form for creating a new resource.
     *
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Ticket::class);

        $projects = Project::where('manager_id', auth()->user()->id)->get();

        $developers = User::role('developer')->get();

        return view('tickets.create', compact('projects', 'developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Ticket::class);

        $validator = Validator::make($request->all(), [
            'project_id' => ['numeric', 'required', 'exists:projects,id'],
            'title' => ['string', 'required', 'min:3', 'max:255'],
            'description' => ['string', 'required', 'min:3'],
            'developer_id' => ['numeric', 'required', 'exists:users,id'],
            'type' => ['required'],
            'priority' => ['required'],
            'duedate' => ['date', 'required', 'after:now'],
        ]);

        if ($validator->fails()) {
            return redirect('/tickets/create')
                ->withErrors($validator)
                ->withInput();
        }

        $ticket = new Ticket(request(['title', 'description', 'type', 'priority', 'duedate']));
        $ticket->project_id = request('project_id');
        $ticket->developer_id = request('developer_id');
        $ticket->save();

        // developer gets a notification that he or she has been assigned to a ticket
        $ticket->developer->notify(new ProjectAndTicketNotification(auth()->user(), $ticket, 'Ticket', 'assign'));

        return redirect('tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        return view('tickets.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $ticket_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $project = $ticket->project;
        $developers = $project->developers;
        $duedate = $ticket->duedate->format("Y-m-d\TH:i:s");

        return view('tickets.edit', compact('ticket', 'project', 'developers', 'duedate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'required', 'min:3', 'max:255'],
            'description' => ['string', 'required', 'min:3'],
            'developer' => ['numeric', 'required', 'exists:users,id'],
            'type' => ['required'],
            'status' => ['required'],
            'priority' => ['required'],
            'duedate' => ['date', 'required', 'after_or_equal:created_at'],
        ]);

        if ($validator->fails()) {
            return redirect("/tickets/{$ticket->id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $ticket->update(request(['title', 'description', 'type', 'status', 'priority', 'duedate']));
        $ticket->developer_id = request('developer');

        // manager gets a notification that the ticket has been updated
        $ticket->project->manager->notify(new ProjectAndTicketNotification(auth()->user(), $ticket, 'Ticket', 'update'));

        return redirect("/tickets/{$ticket->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $ticket_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);

        $ticket->developer->notify(new ProjectAndTicketNotification(auth()->user(), $ticket, 'Ticket', 'delete'));

        $ticket->delete();

        return redirect('tickets');
    }
}
