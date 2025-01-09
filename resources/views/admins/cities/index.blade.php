@extends('admins.layouts.master')
@section('header', 'Cities')
@section('active', 'Cities')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Cities</h3>
                <a href="{{ route('cities.create') }}" class="btn btn-primary">
                    Create
                </a>
            </div>

            <div class="card-body p-0">
                <table class="table" id="cities-list">
                    <thead>
                        <tr>
                            <th style="width: 100px">#</th>
                            <th >Name</th>
                            <th>Governorate</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($cities as $city)
                            <tr id="city-{{ $city->id }}">
                                <td>{{ $loop->iteration }}.</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->governorate ? $city->governorate->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('cities.edit', $city->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('cities.destroy', $city->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this city?')">Delete</button>
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
                    {{ $cities->links() }}
                </div>
            </div>
        </div>
    </div>



@endsection
