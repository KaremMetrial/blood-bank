@extends('admins.layouts.master')
@section('header', 'Governorates')
@section('active', 'Governorates')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Governorates</h3>
                <a href="{{ route('governorates.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table" id="governorates-list">
                    <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th style="width: 80%">Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($governorates as $governorate)
                            <tr id="governorate-{{ $governorate->id }}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $governorate->name }}</td>
                                <td>
                                    <a href="{{ route('governorates.edit', $governorate->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('governorates.destroy', $governorate->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this governorate?')">Delete</button>
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
                    {{ $governorates->links() }}
                </div>
            </div>
        </div>
    </div>



@endsection
