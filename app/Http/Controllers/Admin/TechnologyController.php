<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\EditTechnologyRequest;
use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTechnologyRequest;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $technologies = Technology::paginate();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.technologies.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateTechnologyRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $new_technology = new Technology;
        $new_technology->fill($data);
        $new_technology->save();

        return redirect()->route('admin.technologies.show', $new_technology)->with('message', 'Tecnologia creata con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     */
    public function update(EditTechnologyRequest $request, Technology $technology)
    {
        $request->validated();

        $data = $request->all();
        $technology->update($data);
        return redirect()->route('admin.technologies.show', compact('technology'))->with('message', 'Tecnologia modificata con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('message', 'Tecnologia eliminata con successo');
    }
}
