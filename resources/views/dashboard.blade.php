@extends('layout.template')
@section('title', 'Dashboard')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
@section('content')
    <div class="row p-3 mx-5 my-4 title-section">
        <div class="col p-0">
            <h1 class="h1 p-0 m-0 dashboard-title">Dashboard</h1>
            <p class="p-0 m-0 dashboard-subtitle">Track and Analyze Your Financial Performance</p>
        </div>
        <div class="col p-0 justify-content-end d-flex align-items-center">
            <div class="notification-icon-container mx-4">
                <a href="#" class="text-decoration-none text-dark">
                    <img src="{{ asset('assets/icons/iconoir_bell-notification.png') }}" class="bell-icon" alt="Notification Icon">
                </a>
            </div>
            <div class="profile-icon-container ms-1">
                <a href="#" class="text-decoration-none text-dark">
                    
                </a>
            </div>
        </div>
    </div>
    <div class="row m-0 p-0">
        <div class="col">
            <div class="row m-0 p-0">

            </div>
            <div class="row m-0 p-0">
                
            </div>
        </div>
        <div class="col">

        </div>
    </div>
@endsection