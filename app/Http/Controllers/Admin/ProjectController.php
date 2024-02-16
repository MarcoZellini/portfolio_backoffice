<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.projects.index', ['projects' => Project::orderByDesc('id')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.projects.create',
            [
                'types' => Type::all(),
                'technologies' => Technology::all()
            ],

        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //dd($request);
        $val_data = $request->validated();

        $val_data['slug'] = Project::generateSlug($request->title);

        if ($request->has('cover_image')) {
            $path = Storage::put('placeholders', $request->cover_image);
            $val_data['cover_image'] = $path;
        }

        $project = Project::create($val_data);
        $project->technologies()->attach($request->technologies);

        return to_route('admin.projects.index')->with('message', 'Well Done! Project created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return view(
            'admin.projects.edit',
            [
                'project' => $project,
                'types' => Type::all(),
                'technologies' => Technology::all()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $val_data = $request->validated();



        if ($request->has('cover_image')) {
            $path = Storage::put('placeholders', $request->cover_image);
            $val_data['cover_image'] = $path;

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
        }

        if (!Str::is($project->getOriginal('title'), $request['title'])) {
            $val_data['slug'] = Project::generateSlug($request->title);
        }

        $project->update($val_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return to_route('admin.projects.index')->with('message', 'Well Done! Project edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return to_route('admin.projects.index')->with('message', 'Well Done! Project deleted successfully!');
    }

    public function trashed()
    {
        return view('admin.projects.trash', ['trashedProjects' => Project::onlyTrashed()->orderByDesc('id')->paginate(7)]);
    }

    public function restoreTrash($slug)
    {
        $project = Project::withTrashed()->where('slug', '=', $slug)->first();
        $project->restore();
        return to_route('admin.projects.trash')->with('message', 'Well Done! Project restored successfully!');
    }

    public function forceDestroy($slug)
    {
        $project = Project::withTrashed()->where('slug', '=', $slug)->first();

        if ($project->technologies) {
            $project->technologies()->detach();
        }

        $project->forceDelete();

        return to_route('admin.projects.trash')->with('message', 'Well Done! Project deleted successfully!');
    }
}
