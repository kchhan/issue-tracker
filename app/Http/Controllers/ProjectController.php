<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Notifications\ProjectAndTicketNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
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
        $this->authorize('viewAny', Project::class);

        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $developers = User::role('developer')->get();

        return view('projects.create', compact('developers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Project::class);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'required', 'min:3', 'max:255'],
            'description' => ['string', 'required', 'min:3'],
            'duedate' => ['date', 'required', 'after:today'],
        ]);

        if ($validator->fails()) {
            return redirect('/projects/create')
                ->withErrors($validator)
                ->withInput();
        }

        $project = new Project(request(['title', 'description', 'duedate']));
        $project->manager_id = auth()->id();
        $project->save();

        $project->developers()->sync(request('developers'));

        // notify all assigned developers that they are part of a new project
        foreach ($project->developers as $developer) {
            $developer->notify(new ProjectAndTicketNotification(auth()->user(), $project, 'Project', 'assign'));
        }

        return redirect('projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $developers = User::role('developer')->get();
        $duedate = $project->duedate->format("Y-m-d\TH:i:s");

        return view('projects.edit', compact('project', 'developers', 'duedate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $validator = Validator::make($request->all(), [
            'title' => ['string', 'required', 'min:3'],
            'description' => ['string', 'required', 'min:3'],
            'developers' => ['array', 'required', 'exists:users,id'],
            'status' => ['required'],
            'priority' => ['required'],
            'duedate' => ['date', 'required', 'after_or_equal:created_at'],
        ]);

        if ($validator->fails()) {
            return redirect("/projects/{$project->id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $project->update(request(['title', 'description', 'status', 'priority', 'duedate']));

        $project->developers()->sync(request('developers'));

        // notify the developers that the manager has updated the project
        foreach ($project->developers as $developer) {
            $developer->notify(new ProjectAndTicketNotification(auth()->user(), $project, 'Project', 'update'));
        }

        return redirect("/projects/{$project->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        // notify the developers that the manager has deleted the project
        foreach ($project->developers as $developer) {
            $developer->notify(new ProjectAndTicketNotification(auth()->user(), $project, 'Project', 'delete'));
        }

        $project->delete();

        return redirect('projects');
    }
}
