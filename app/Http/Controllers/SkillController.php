<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Skills/All', [
            'skills' => Skill::all(),
            'colors' => Skill::getAvailableBgColors(),
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
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableBgColors())
            ]
        ]);

        //  use all information provided in the request to create a new skill
        Skill::create($request->all());

        return redirect()->route('skills.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function show(Skill $skill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function edit(Skill $skill)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)->ignore($skill->id)
            ],
            'color' => [
                'required',
                'in:' . implode(',', Skill::getAvailableBgColors())
            ],
        ]);

        $skill->update($request->all());

        return redirect()->route('skills.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skill  $skill
     * @return \Illuminate\Http\Response
     */
    public function destroy(Skill $skill)
    {
        //
    }
}
