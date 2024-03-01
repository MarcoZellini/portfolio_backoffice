@extends('layouts.admin')

@section('page-title', 'Create Project')


@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>Error! </strong> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="my-5">

            @csrf

            <h2 class="mb-4">New Project</h2>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="title" id="title" placeholder="">
                <label for="title">Title</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
                    <option selected disabled>Select one</option>
                    <option value="">Untyped</option>

                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                            {{ $type->name }}</option>
                    @endforeach

                </select>
                <label for="type_id">Choose a Typology</label>
            </div>

            <label for="technologies[]" class="ms-0">Choose which Technologies</label>
            <div class="form-floating d-flex justify-content-center flex-wrap my-3">
                @foreach ($technologies as $technology)
                    <div class="form-check form-check-inline ps-3">
                        <label class="form-check-label" for="technology-{{ $technology->id }}">
                            <input class="form-check-input" type="checkbox" id="technology-{{ $technology->id }}"
                                name="technologies[]" value="{{ $technology->id }}"
                                {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}>
                            {{ $technology->name }}
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="form-floating mb-3">
                <input type="file" name="cover_image" id="cover_image"
                    class="image_input form-control @error('cover_image') is-invalid @enderror"
                    placeholder="Insert project image" aria-describedby="helpId">
                <label for="cover_image" class="form-label">Image</label>
            </div>
            <div class="form-floating mb-3">
                <input type="url" class="form-control @error('website_link') is-invalid @enderror" name="website_link"
                    id="website_link" placeholder="" value="{{ old('website_link') }}">
                <label for="website_link">Website Link</label>
            </div>
            <div class="form-floating mb-3">
                <input type="url" class="form-control @error('github_link') is-invalid @enderror" name="github_link"
                    id="github_link" placeholder="" value="{{ old('github_link') }}">
                <label for="github_link">GitHub Link</label>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="description" id="description" rows="5"
                    placeholder="Insert project description">{{ old('descritpion') }}</textarea>
                <label for="description" class="form-label @error('description') is-invalid @enderror">Description</label>
            </div>
            <button type="submit" class="btn_primary">Create New Project</button>

        </form>
    </div>
@endsection
