<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Projects/All', [
            'projects' => Project::all(),
            'colors' => Project::getAvailableTextColors(),
            'icons' => Project::getAvailableIcons()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ]
        ]);

        Project::create($request->all());

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique(Project::class)->ignore($project->id)
            ],
            'description' => [
                'required',
                'max:255',
            ],
            'color' => [
                'required',
                'in:' . implode(',', Project::getAvailableTextColors())
            ],
            'icon_name' => [
                'required',
                'in:' . implode(',', Project::getAvailableIcons())
            ]
        ]);

        $project->update($request->all());

        return redirect()->route('projects.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
