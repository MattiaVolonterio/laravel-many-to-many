<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\EditProjectRequest;
use App\Mail\CreateProjectMail;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $projects = Project::paginate();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(CreateProjectRequest $request)
    {

        $request->validated();

        $data = $request->all();
        $new_project = new Project;
        $new_project->fill($data);

        if (Arr::exists($data, 'project_image')) {
            $img_path = Storage::put('uploads/projects', $data['project_image']);
            $new_project->project_image = $img_path;
        }


        $new_project->save();

        $new_project->technologies()->attach($data['technologies']);

        Mail::to('mailprova@mail.com')->send(new CreateProjectMail(Auth::user(), $new_project));

        return redirect()->route('admin.projects.show', $new_project)->with('message', 'Progetto creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        $project_technology_id = $project->technologies->pluck('id')->toArray();

        return view('admin.projects.edit', compact('project', 'types', 'technologies', 'project_technology_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     */
    public function update(EditProjectRequest $request, Project $project)
    {

        $request->validated();

        $data = $request->all();
        $project->fill($data);

        if (Arr::exists($data, 'project_image')) {
            if (!empty($project->project_image)) {
                Storage::delete($project->project_image);
            }

            $img_path = Storage::put('uploads/projects', $data['project_image']);
            $project->project_image = $img_path;
        }

        $project->save();

        if (Arr::exists($data, 'technologies')) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->detach();
        }


        return redirect()->route('admin.projects.show', compact('project'))->with('message', 'Progetto modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'Progetto eliminato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     */
    public function destroyImage(Project $project)
    {
        Storage::delete($project->project_image);
        $project->project_image = null;
        $project->save();
        return redirect()->back();
    }
}
