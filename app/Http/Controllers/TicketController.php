<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::all();

        return view('tickets.index', [
            'tickets' => $tickets,
        ]);
    }

    /*
     * Show the form for creating a new resource.
     *
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = Project::all();
        // TODO: only send developers
        $developers = User::all();

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
        $validator = Validator::make($request->all(), [
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'developer_id' => ['required', 'exists:users,id'],
            'type' => 'required',
            'priority' => 'required',
            'duedate' => 'required',
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
        return view('tickets.show', [
            'ticket' => $ticket,
            'project' => Project::find($ticket->project_id),
            'developer' => User::find($ticket->developer_id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
