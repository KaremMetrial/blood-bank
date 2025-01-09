@extends('admins.layouts.master')
@section('header', 'Dashboard')
@section('active', 'Dashboard')
@inject('clients', 'App\Models\Client')
@inject('donationRequests', 'App\Models\DonationRequest')
@inject('governorates', 'App\Models\Governorate')
@inject('cities', 'App\Models\City')
@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Clients</span>
                    <span class="info-box-number">{{ $clients->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-chart-line"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Donation Request</span>
                    <span class="info-box-number">{{ $donationRequests->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-warning text-white"><i class="fas fa-map-marked-alt"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Governorates</span>
                    <span class="info-box-number">{{ $governorates->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-city"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text"> Cities</span>
                    <span class="info-box-number">{{ $cities->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
@endsection
