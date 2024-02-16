@extends('layouts.admin')

@section('page-title', 'Edit Project ' . $project->id)

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li><strong>Error! </strong> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', ['project' => $project]) }}" method="POST" enctype="multipart/form-data"
        class="my-5">

        @csrf
        @method('PUT')
        <h2 class="mb-4">Edit Project</h2>

        <div class="mb-4">
            <label for="title" class="form-label">Edit Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                placeholder="Edit project title" aria-describedby="helpId" value="{{ old('title', $project->title) }}">
        </div>
        <div class="mb-3">
            <label for="type_id" class="form-label">Choose a Typology</label>
            <select class="form-select form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                <option selected disabled>Select one</option>
                <option value="">Untyped</option>

                @foreach ($types as $type)
                    <option value="{{ $type->id }}"
                        {{ $type->id == old('type_id', $project->type_id) ? 'selected' : '' }}>
                        {{ $type->name }}</option>
                @endforeach

            </select>
        </div>

        <label for="type_id" class="form-label d-block">Choose which Technologies</label>
        <div class="my-4">
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline">
                    <label class="form-check-label" for="technology-{{ $technology->id }}">
                        @if ($errors->any())
                            <input class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                name="technologies[]" value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                        @else
                            <input class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                name="technologies[]" value="{{ $technology->id }}"
                                {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                        @endif
                        {{ $technology->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="mb-4">
            <label for="cover_image" class="form-label">Edit Image</label>
            <input type="file" name="cover_image" id="cover_image"
                class="form-control @error('cover_image') is-invalid @enderror" placeholder="Edit project image"
                aria-describedby="helpId">
        </div>
        <div class="mb-4">
            <label for="website_link" class="form-label">Edit Website Link</label>
            <input type="url" name="website_link" id="website_link"
                class="form-control @error('website_link') is-invalid @enderror" placeholder="Edit project website link"
                aria-describedby="helpId" value="{{ old('website_link', $project->website_link) }}">
        </div>
        <div class="mb-4">
            <label for="github_link" class="form-label">Edit GitHub Link</label>
            <input type="url" name="github_link" id="github_link"
                class="form-control @error('github_link') is-invalid @enderror" placeholder="Edit project GitHub link"
                aria-describedby="helpId" value="{{ old('github_link', $project->github_link) }}">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label @error('description') is-invalid @enderror">Edit
                Description</label>
            <textarea class="form-control" name="description" id="description" rows="5"
                placeholder="Edit project description">{{ old('descritpion', $project->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Edit Project</button>

    </form>
@endsection
