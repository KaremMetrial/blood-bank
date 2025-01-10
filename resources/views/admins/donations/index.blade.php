@extends('admins.layouts.master')
@section('header', 'Donations')
@section('active', 'Donations')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Donations</h3>
                <form action="{{ route('donations.index') }}" method="GET" class="d-flex">
                    <div class="d-flex">

                        <!-- City Filter -->
                        <div class="form-group me-2">
                            <select class="form-control" name="city_id">
                                <option value="">All Cities</option>
                                @foreach ($cities as $city)
                                    <option
                                        value="{{ $city->id }}" {{ request('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Blood Type Filter -->
                        <div class="form-group me-2">
                            <select class="form-control" name="blood_type_id">
                                <option value="">All Blood Types</option>
                                @foreach ($bloodTypes as $bloodType)
                                    <option
                                        value="{{ $bloodType->id }}" {{ request('blood_type_id') == $bloodType->id ? 'selected' : '' }}>
                                        {{ $bloodType->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body p-0">
                <table class="table" id="clients-list">
                    <thead>
                    <tr>
                        <th style="width: 100px">#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Last Donation Date</th>
                        <th>City</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($donations as $donation)
                        <tr id="donation-{{ $donation->id }}">
                            <td>{{ $donation->iteration }}.</td>
                            <td>{{ $donation->patient_name }}.</td>
                            <td>{{ $donation->patient_phone }}.</td>
                            <td>{{ $donation->city->name }}.</td>
                            <td>{{ $donation->bloodType->name }}.</td>
                            <td>
                                <a href="{{ route('donations.show', $donation->id) }}" class="btn btn-primary">Show</a>
                                <form action="{{ route('donations.destroy', $donation->id) }}" method="POST"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this client?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Found Data</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="p-2">
                    {{ $donations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
