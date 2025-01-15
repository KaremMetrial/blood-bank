@extends('admins.layouts.master')
@push('css')
@endpush
@section('header', 'Roles')
@section('active', 'Roles')

    @section('content')
        <div class="row">
            <div class="card w-100">
                <div class="card-header d-flex">
                    <h3 class="card-title mb-0 flex-grow-1">Add New Role</h3>
                    <a href="{{ route('roles.index') }}" class="btn btn-danger">
                        Back
                    </a>
                </div>

                <div class="card-body p-0">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="permissions">Permissions</label>
                                    <div>
                                        @foreach($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                       value="{{ $permission->id }}"
                                                       id="permission-{{ $permission->id }}">
                                                <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
    @endpush
