@extends('layouts.admin')

@section('page-title', 'Admin - Edit Technology ' . $technology->id)

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

        <form action="{{ route('admin.technologies.update', ['technology' => $technology]) }}" method="POST" class="my-5">

            @csrf
            @method('PUT')
            <h2 class="mb-4">Edit Technology</h2>

            <div class="form-floating mb-3">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Edit Technology Name" aria-describedby="helpId"
                    value="{{ old('name', $technology->name) }}">
                <label for="name" class="form-label">Edit Name</label>
            </div>


            <button type="submit" class="btn_primary">Edit Technology</button>

        </form>
    </div>
@endsection
