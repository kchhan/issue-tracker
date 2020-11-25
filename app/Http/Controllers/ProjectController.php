<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', [
            'projects' => $projects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO: only send developers
        return view('projects.create', [
            'developers' => User::all(),
        ]);
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
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'developers' => 'exists:users,id',
            'due_on' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('/projects/create')
                ->withErrors($validator)
                ->withInput();
        }

        $project = new Project(request(['title', 'description', 'due_on']));
        $project->manager_id = auth()->id();
        $project->save();

        $project->developers()->sync(request('developers'));

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
        return view('projects.show', [
            'project' => $project,
            'developers' => $project->developers()->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $developers = User::all();
        // dd($project->description);
        return view('projects.edit', compact('project', 'developers'));
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
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'developers' => 'exists:users,id',
            'type' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'due_on' => ['required', 'after_or_equal:created_at'],
        ]);

        if ($validator->fails()) {
            return redirect('/projects/{$project->id}/edit')
                ->withErrors($validator)
                ->withInput();
        }

        $project->update(request(['title', 'description', 'type', 'status', 'priority', 'due_on']));

        $project->developers()->sync(request('developers'));

        return redirect("/projects/" . $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $project_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {

    }
}
