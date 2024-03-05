@extends('layouts.admin')

@section('page-title', 'Admin - Trashed Types')

@section('content')
    <div class="container">

        <div class="d-flex flex-column flex-lg-row align-items-lg-center">
            <h2 class="fs-4 text-capitalize flex-grow-1">
                Trashed {{ __(Request::segment(2)) }}
            </h2>
            <a class="btn_primary my-2 my-lg-0 mx-lg-2" href="{{ route('admin.types.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-plus-circle me-2" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                    <path
                        d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                </svg>Add New Typology
            </a>
            <a class="btn_primary my-2 my-lg-0 mx-lg-2" href="{{ route('admin.types.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-kanban me-2" viewBox="0 0 16 16">
                    <path
                        d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z" />
                    <path
                        d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z" />
                </svg>Back to Typology
            </a>
        </div>

        @if (session('message'))
            <div class="alert alert-success my-3" role="alert">
                {{ session('message') }} 🤩
            </div>
        @endif

        <div class="table-responsive my-3">
            <table class="table text-center align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">NAME</th>
                        <th scope="col" class="d-none d-lg-table-cell">DATE</th>
                        <th scope="col">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($trashedTypes as $type)
                        <tr>
                            <td>{{ $type->id }}</td>
                            <td>{{ $type->name }}</td>
                            <td class="d-none d-lg-table-cell"><small>{{ date($type->created_at) }}</small></td>
                            <td>
                                <div class="row row-cols-1 row-cols-md-2 m-0">

                                    <div class="col px-1">
                                        <!-- Modal trigger button -->
                                        <a type="button" class="btn_success m-1 mx-sm-0 mb-sm-0" data-bs-toggle="modal"
                                            data-bs-target="#modalId-restore-{{ $type->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-kanban" viewBox="0 0 16 16">
                                                <path
                                                    d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z" />
                                                <path
                                                    d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z" />
                                            </svg>
                                            Restore
                                        </a>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-restore-{{ $type->id }}" tabindex="-1"
                                            data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Restoring type
                                                            {{ $type->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Do you want to restore this type?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn_primary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form
                                                            action="{{ route('admin.types.restore', ['type' => $type->slug]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn_success">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-kanban me-2" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z" />
                                                                    <path
                                                                        d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z" />
                                                                </svg>Restore</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col px-1">
                                        <!-- Modal trigger button -->
                                        <a type="button" class="btn_danger m-1 mx-sm-0 mb-sm-0" data-bs-toggle="modal"
                                            data-bs-target="#modalId-force-delete-{{ $type->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path
                                                    d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path
                                                    d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg>
                                            Delete
                                        </a>

                                        <!-- Modal Body -->
                                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                        <div class="modal fade" id="modalId-force-delete-{{ $type->id }}"
                                            tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                            aria-labelledby="modalTitleId-{{ $type->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId-{{ $type->id }}">
                                                            Deleting
                                                            type
                                                            #{{ $type->id }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Danger! This cannot be undone.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn_primary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form
                                                            action="{{ route('admin.types.forceDestroy', ['type' => $type->slug]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn_danger"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="16"
                                                                    height="16" fill="currentColor"
                                                                    class="bi bi-trash" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                                    <path
                                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                                </svg>Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">There aren't types! 😒</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination justify-content-end align-items-center">
            {{ $trashedTypes->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
