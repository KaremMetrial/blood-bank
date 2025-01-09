@extends('admins.layouts.master')
@section('header', 'Cities')
@section('active', 'Cities')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Add New Governorate</h3>
                <a href="{{ route('cities.index') }}" class="btn btn-danger">
                    Back
                </a>

            </div>

            <div class="card-body p-0">
                <form action="{{ route('cities.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Name" required>
                            </div>

                            <div class="form-group">
                                <label for="governorate">Select Governorate</label>
                                <select class="form-control" id="governorate" name="governorate_id" required>
                                    <option value="">Select Governorate</option>
                                    @foreach ($governorates as $governorate)
                                        <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                    @endforeach
                                </select>
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
