@extends('layout.template')
@section('title', 'Profile')
@section('content')

    <h1 class="mt-5 mb-4 ms-5 me-5 page-title" style="color: #005CAB;">Profile</h1>

    {{-- Profile Picture Section --}}
    <form method="POST" action="{{ route('user.updateProfilePicture') }}" enctype="multipart/form-data">
        @csrf
        <div class="d-flex justify-content-center position-relative">
            <img id="preview_profile"
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('assets/images/logo.jpg') }}"
                class="rounded-circle shadow" width="150" height="150" alt="profile picture">

            <input type="file" name="profile_picture" id="profile_picture_input" class="d-none" accept="image/*"
                onchange="this.form.submit()">

            <button type="button" onclick="document.getElementById('profile_picture_input').click();"
                class="btn rounded-circle position-absolute"
                style="bottom: 0; right: 42%; width: 40px; height: 40px; padding: 8px; background-color: #005CAB; color: white;">
                <img src="{{ asset('assets/images/pen.png') }}" width="20px" height="20px">
            </button>
        </div>
    </form>

    {{-- ===== VIEW MODE ===== --}}
    <div id="profile-view" class="d-flex justify-content-center mt-5">
        <div class="card gap-4 border border-0" style="width: 35%;">
            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">Email: <span>{{ $user->email }}</span></li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">Username: <span>{{ $user->username }}</span></li>
            </ul>

            <ul class="list-group list-group-flush border border-secondary rounded shadow-sm">
                <li class="list-group-item text-body-tertiary">Currency: <span>{{ $user->currency }}</span></li>
            </ul>

            {{-- Update Profile Button --}}
            <div class="d-flex justify-content-center mt-4">
                <button onclick="enableEdit()" class="btn text-white" style="background-color: #005CAB; width: 100%;">Update Profile</button>
            </div>
        </div>
    </div>

    {{-- ===== EDIT MODE ===== --}}
    <div id="profile-edit" class="d-none d-flex justify-content-center mt-5">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" style="width: 35%;">
            @csrf
            @method('PUT')

            <input type="email" name="email" class="form-control mb-2" value="{{ $user->email }}" required>

            <input type="text" name="username" class="form-control mb-2" value="{{ $user->username }}" required>

            <select name="currency" class="form-select mb-3" required>
                <option value="IDR" {{ $user->currency == 'IDR' ? 'selected' : '' }}>IDR</option>
                <option value="USD" {{ $user->currency == 'USD' ? 'selected' : '' }}>USD</option>
                <option value="JPY" {{ $user->currency == 'JPY' ? 'selected' : '' }}>JPY</option>
                <option value="CNY" {{ $user->currency == 'CNY' ? 'selected' : '' }}>CNY</option>
                <option value="KRW" {{ $user->currency == 'KRW' ? 'selected' : '' }}>KRW</option>
            </select>

            <button type="submit" class="btn text-white" style="background-color: #005CAB; width: 100%;">Submit</button>
        </form>
    </div>

    {{-- Log Out Button --}}
    <form method="POST" action="{{ route('logout') }}" class="d-flex justify-content-end fixed-bottom mb-5 me-5">
        @csrf
        <button type="submit" class="btn text-white" style="background-color: #005CAB">
            Log Out <img src="{{ asset('assets/images/log out.png') }}" width="15px" height="15px" class="ms-2">
        </button>
    </form>

    {{-- Scripts --}}
    <script>
        function enableEdit() {
            document.getElementById('profile-view').classList.add('d-none');
            document.getElementById('profile-edit').classList.remove('d-none');
        }

        // Preview profile image before upload
        const input = document.getElementById('profile_picture_input');
        const preview = document.getElementById('preview_profile');

        if (input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    preview.src = URL.createObjectURL(file);
                }
            });
        }
    </script>

@endsection

