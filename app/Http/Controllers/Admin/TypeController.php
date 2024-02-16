<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Project;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.types.index', ['types' => Type::orderByDesc('id')->paginate(7)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $val_data = $request->validated();
        $val_data['slug'] = Type::generateSlug($val_data['name']);
        Type::create($val_data);

        return to_route('admin.types.index')->with('message', 'Well Done! Type created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view(
            'admin.types.show',
            [
                'type' => $type,
                'projects' => Project::all()->where('type_id', '=', $type->id)
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', ['type' => $type]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {

        $val_data = $request->validated();
        $val_data['slug'] = Type::generateSlug($val_data['name']);
        $type->update($val_data);

        return to_route('admin.types.index')->with('message', 'Well Done! Type Edited successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type->delete();
        return to_route('admin.types.index')->with('message', 'Well Done! Type Deleted successfully!');
    }

    public function trashed()
    {
        return view('admin.types.trash', ['trashedTypes' => Type::onlyTrashed()->orderByDesc('id')->paginate(7)]);
    }

    public function restoreTrash($slug)
    {
        $type = Type::withTrashed()->where('slug', '=', $slug)->first();
        $type->restore();
        return to_route('admin.types.trash')->with('message', 'Well Done! Type Restored Successfully!');
    }

    public function forceDestroy($slug)
    {
        $type = Type::withTrashed()->where('slug', '=', $slug)->first();

        foreach ($type->projects as $project) {
            $project->update([
                'type_id' => null
            ]);
        }

        $type->forceDelete();

        return to_route('admin.types.trash')->with('message', 'Well Done! Type Deleted Successfully!');
    }
}
