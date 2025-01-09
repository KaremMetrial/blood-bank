@extends('admins.layouts.master')
@section('header', 'Clients')
@section('active', 'Clients')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Edit Client</h3>
                <a href="{{ route('clients.index') }}" class="btn btn-danger">
                    Back
                </a>
            </div>

            <div class="card-body p-0">
                <form action="{{ route('clients.update', $client->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <!-- Name -->
                            <div class="form-group col-6">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required
                                       value="{{ old('name', $client->name) }}">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="form-group col-6">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required
                                       value="{{ old('phone', $client->phone) }}">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Email -->
                            <div class="form-group col-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required
                                       value="{{ old('email', $client->email) }}">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Date of Birth -->
                            <div class="form-group col-6">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required
                                       value="{{ old('date_of_birth', $client->d_o_b ? $client->d_o_b->format('Y-m-d') : '') }}">
                                @error('date_of_birth')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Blood Type -->
                            <div class="form-group col-6">
                                <label for="blood_type_id">Blood Type</label>
                                <select class="form-control" id="blood_type_id" name="blood_type_id" required>
                                    @foreach ($bloodTypes as $bloodType)
                                        <option value="{{ $bloodType->id }}" {{ old('blood_type_id', $client->blood_type_id) == $bloodType->id ? 'selected' : '' }}>
                                            {{ $bloodType->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('blood_type_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- City -->
                            <div class="form-group col-6">
                                <label for="city_id">City</label>
                                <select class="form-control" id="city_id" name="city_id" required>
                                    @foreach ($cities as $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $client->city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('city_id')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Last Donation Date -->
                            <div class="form-group col-6">
                                <label for="last_donation_date">Last Donation Date</label>
                                <input type="date" class="form-control" id="last_donation_date" name="last_donation_date" required
                                       value="{{ old('last_donation_date', $client->last_donation_date ? $client->last_donation_date->format('Y-m-d') : '') }}">
                                @error('last_donation_date')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="form-group col-6">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option value="1" {{ old('status', $client->status) == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status', $client->status) == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group col-12 text-center">
                            <button type="submit" class="btn btn-primary">Update Client</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
