<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTypeRequest;
use App\Http\Requests\EditTypeRequest;
use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $types = Type::paginate();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return view('admin.types.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateTypeRequest $request)
    {
        $request->validated();

        $data = $request->all();
        $new_type = new Type;
        $new_type->fill($data);
        $new_type->save();

        return redirect()->route('admin.types.show', $new_type)->with('message', 'Tipologia creata con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     */
    public function edit(Type $type)
    {
        return view('admin.types.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     */
    public function update(EditTypeRequest $request, Type $type)
    {
        $request->validated();

        $data = $request->all();
        $type->update($data);
        return redirect()->route('admin.types.show', compact('type'))->with('message', 'Tipologia modificata con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     */
    public function destroy(Type $type)
    {

        foreach ($type->projects as $project) {
            $project->delete();
        }

        $type->delete();
        return redirect()->route('admin.types.index')->with('message', 'Tipo eliminato con successo');
    }
}
