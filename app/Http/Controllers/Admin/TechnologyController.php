<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Http\Controllers\Controller;
use App\Models\Project;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.technologies.index', ['technologies' => Technology::orderByDesc('id')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Technology::generateSlug($val_data['name']);
        Technology::create($val_data);

        return to_route('admin.technologies.index')->with('message', 'Well Done! Technology created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', [
            'technology' => $technology,
            'projects' => $technology->projects
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', ['technology' => $technology]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Technology::generateSlug($val_data['name']);
        $technology->update($val_data);

        return to_route('admin.technologies.index')->with('message', 'Well Done! Technology Edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        return to_route('admin.technologies.index')->with('message', 'Well Done! Technology Deleted successfully!');
    }

    public function trashed()
    {
        return view('admin.technologies.trash', ['trashedTechnologies' => Technology::onlyTrashed()->orderByDesc('id')->paginate(7)]);
    }

    public function restoreTrash($slug)
    {
        $technology = Technology::withTrashed()->where('slug', '=', $slug)->first();
        $technology->restore();
        return to_route('admin.technologies.trash')->with('message', 'Well Done! Type Restored Successfully!');
    }

    public function forceDestroy($slug)
    {
        $technology = Technology::withTrashed()->where('slug', '=', $slug)->first();

        $technology->projects()->detach();

        $technology->forceDelete();
        return to_route('admin.technologies.trash')->with('message', 'Well Done! Type Deleted Successfully!');
    }
}
