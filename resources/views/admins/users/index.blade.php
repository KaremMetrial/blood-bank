@extends('admins.layouts.master')
@section('header', 'Users')
@section('active', 'Users')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Users</h3>
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table" id="users-list">
                    <thead>
                    <tr>
                        <th style="width: 100px">#</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($users as $user)
                        <tr id="city-{{ $user->id }}">
                            <td>{{ $loop->iteration }}.</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @forelse ($user->getRoleNames() as $role)
                                    <span class="badge bg-info text-dark">{{ $role }}</span>
                                @empty
                                    <span class="badge bg-warning text-dark">No Role Assigned</span>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}"
                                   class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                        Delete
                                    </button>
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

                <div class="p-2">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
