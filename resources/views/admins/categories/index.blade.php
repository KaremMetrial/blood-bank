@extends('admins.layouts.master')
@section('header', 'Categories')
@section('active', 'Categories')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Categories</h3>
                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table" id="categories-list">
                    <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th style="width: 80%">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr id="city-{{ $category->id }}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>



@endsection
