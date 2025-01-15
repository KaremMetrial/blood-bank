@extends('admins.layouts.master')
@section('header', 'Roles')
@section('active', 'Roles')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Roles</h3>
                <a href="{{ route('roles.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table" id="roles-list">
                    <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th style="width: 80%">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr id="governorate-{{ $role->id }}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('roles.show', $role->id) }}"
                                        class="btn btn-primary btn-sm">Details</a>
                                    <a href="{{ route('roles.edit', $role->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No Found Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>



@endsection
