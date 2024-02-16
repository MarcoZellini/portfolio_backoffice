@extends('layouts.admin')

@section('page-title', 'Admin - Create Technology')

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

    <form action="{{ route('admin.technologies.store') }}" method="POST" class="my-5">

        @csrf

        <h2 class="mb-4">Add New Technology</h2>

        <div class="mb-4">
            <label for="name" class="form-label">Add Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                placeholder="Insert Technology name" aria-describedby="helpId" value="{{ old('name') }}">
        </div>

        <button type="submit" class="btn btn-primary">Create New Technology</button>

    </form>
@endsection
