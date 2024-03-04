@extends('layouts.admin')

@section('page-title', 'Admin - Create Type')

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

        <form action="{{ route('admin.types.store') }}" method="POST" class="my-5">

            @csrf

            <h2 class="mb-4">Add New Typology</h2>

            <div class="form-floating mb-3">
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    placeholder="Insert Type name" aria-describedby="helpId" value="{{ old('name') }}">
                <label for="name" class="form-label">Add Name</label>
            </div>

            <button type="submit" class="btn_primary">Create New Typology</button>

        </form>

    </div>
@endsection
