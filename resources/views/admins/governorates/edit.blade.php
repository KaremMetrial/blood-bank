@extends('admins.layouts.master')
@section('header', 'Governorates')
@section('active', 'Governorates')
@section('content')
    <div class="row">
        <div class="card w-100">
            <div class="card-header d-flex">
                <h3 class="card-title mb-0 flex-grow-1">Edit Governorate</h3>
                <a href="{{ route('governorates.index') }}" class="btn btn-danger" >
                    Back
                </a>
            </div>

            <div class="card-body p-0">
                <form action="{{ route('governorates.update',$governorate->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required value="{{ $governorate->name }}">
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
