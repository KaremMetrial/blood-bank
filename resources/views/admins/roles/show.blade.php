@extends('admins.layouts.master')
@section('header', 'Role Details')
@section('active', 'Roles')
@section('content')

    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Roles</h3>
                <a href="{{ route('roles.index') }}" class="btn btn-danger">
                    back
                </a>
            </div>


            <div class="card-body">

                {{-- Role Info --}}
                <h4>Role Information</h4>
                <table class="table">
                    <tr>
                        <th style="width: 20%">Role Name:</th>
                        <td>{{ $role->name }}</td>
                    </tr>
                </table>

                {{-- Permissions Associated with this Role --}}
                <h4 class="mt-4">Permissions</h4>
                @if ($role->permissions->count() > 0)
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th>Permission Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($role->permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No permissions assigned to this role.</p>
                @endif

            </div>
        </div>
    </div>

@endsection
