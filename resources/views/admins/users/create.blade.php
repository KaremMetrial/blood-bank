@extends('admins.layouts.master')
@section('header', 'Users')
@section('active', 'Users')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Add New User</h3>
                <a href="{{ route('users.index') }}" class="btn btn-danger">
                    Back
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="col-12">
                            {{-- Name Field --}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Enter Name"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>

                            {{-- Email Field --}}
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="Enter Email"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>

                            {{-- Password Field --}}
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    id="password"
                                    name="password"
                                    placeholder="Enter Password"
                                    required
                                >
                            </div>

                            {{-- Roles Dropdown --}}
                            <div class="form-group">
                                <label for="roles">Assign Role</label>
                                <select
                                    name="role"
                                    id="roles"
                                    class="form-control"
                                    required
                                >
                                    <option value="" disabled selected>Select a Role</option>
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->name }}"
                                            {{ old('role') == $role->name ? 'selected' : '' }}
                                        >
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Submit Button --}}
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
