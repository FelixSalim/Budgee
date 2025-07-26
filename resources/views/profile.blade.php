@extends('layout.template')
@section('title', 'Profile')
@section('content')
    <h1 class="mt-5 mb-4 ms-5 me-5 page-title" style="color: #005CAB;">Profile</h1>

    {{-- <div class="mt-5">
        <img src="assets\images\logo.jpg" class="rounded-circle mx-auto d-block shadow" width="13.5%" height="13.5%"
            alt="profile picture">

        <button class="btn btn-primary rounded-circle position-absolute"
            style="bottom: 500px; right: 505px; width: 40px; height: 40px; padding: 8px;">
            <img src="assets\images\pen.png" width="20px" height="20px">
        </button>
    </div> --}}

    <form action="{{ route('user.updateProfilePicture') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-5 position-relative">
            <img id="preview_profile"
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/images/logo.jpg') }}"
                class="rounded-circle mx-auto d-block shadow" width="13.5%" height="13.5%" alt="profile picture">

            <input type="file" name="profile_picture" id="profile_picture_input" class="d-none" accept="image/*"
                onchange="this.form.submit()">

            <button type="button" onclick="document.getElementById('profile_picture_input').click();"
                class="btn btn-primary rounded-circle position-absolute"
                style="bottom: 0; right: 30%; width: 40px; height: 40px; padding: 8px;">
                <img src="{{ asset('assets/images/pen.png') }}" width="20px" height="20px">
            </button>
        </div>
    </form>


    <div class="d-flex justify-content-center mt-5">
        {{-- <div class="card gap-4 border border-0" style="width: 35%;">
            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">E mail: <span>{{ $user->email }}</span></li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">Username: <span>{{ $user->username }}</span></li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">Currency: <span>{{ $user->currency }}</span></li>
            </ul>
        </div> --}}

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-4 d-flex flex-column align-items-center">
            @csrf
            @method('PUT')

            <input type="file" name="profile_picture" class="form-control mb-3" style="width: 35%;">

            <input type="email" name="email" class="form-control mb-2" style="width: 35%;" value="{{ $user->email }}" required>

            <input type="text" name="username" class="form-control mb-2" style="width: 35%;" value="{{ $user->username }}" required>

            <select name="currency" class="form-select mb-3" style="width: 35%;" required>
                <option value="IDR" {{ $user->currency == 'IDR' ? 'selected' : '' }}>IDR</option>
                <option value="USD" {{ $user->currency == 'USD' ? 'selected' : '' }}>USD</option>
                <option value="JPY" {{ $user->currency == 'JPY' ? 'selected' : '' }}>JPY</option>
                <option value="CNY" {{ $user->currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                <option value="KRW" {{ $user->currency == 'KRW' ? 'selected' : '' }}>KRW</option>
            </select>

            <button type="submit" class="btn text-white mb-5" style="background-color: #005CAB; width: 35%;">Update Profile</button>
        </form>


    </div>

    {{-- <div class="d-flex justify-content-end fixed-bottom mb-5 me-5">
        <a href="{{ route('login') }}">
            <button type="button" class="btn text-white" style="background-color: #005CAB;">Log Out
                <img src="assets\images\log out.png" width="15px" height="15px" class="ms-2">
            </button>
        </a>
    </div> --}}

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn text-white" style="background-color: #005CAB">
            Log Out <img src="assets/images/log out.png" width="15px" height="15px" class="ms-2">
        </button>
    </form>

    <script>
        const input = document.getElementById('profile_picture_input');
        const preview = document.getElementById('preview_profile');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        });
    </script>
@endsection
