@extends('layout.template')
@section('title', 'Profile')
@section('content')
    <h1 class="mt-3 ms-3" style="color: #005CAB;">Profile</h1>

    <div class="mt-5">
        <img src="assets\images\logo.jpg" class="rounded-circle mx-auto d-block shadow" width="13.5%" height="13.5%"
            alt="profile picture">

        <button class="btn btn-primary rounded-circle position-absolute"
            style="bottom: 500px; right: 505px; width: 40px; height: 40px; padding: 8px;">
            <img src="assets\images\pen.png" width="20px" height="20px">
        </button>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <div class="card gap-3 border border-0" style="width: 35%;">
            <ul class="list-group list-group-flush border border-secondary rounded border-light-subtle shadow">
                <li class="list-group-item text-body-tertiary">e-mail</li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded border-light-subtle shadow">
                <li class="list-group-item text-body-tertiary">ID</li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded border-light-subtle shadow">
                <li class="list-group-item text-body-tertiary">Currency</li>
            </ul>
        </div>
    </div>

    <div class="d-flex justify-content-end fixed-bottom mb-5 me-5">
        <a href="{{ route('login') }}">
            <button type="button" class="btn text-white" style="background-color: #005CAB;">Log Out
                <img src="assets\images\log out.png" width="15px" height="15px" class="ms-2">
            </button>
        </a>
    </div>
@endsection