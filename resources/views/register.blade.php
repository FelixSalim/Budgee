<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log-in</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
        rel="stylesheet">

    {{-- Local CSS --}}
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
</head>

<body>


    <div class="mt-5 d-flex justify-content-center w-100">
        <img src="assets\images\no-bg logo.png" class="mx-auto d-block img-fluid" width="10%" height="10%"
            alt="profile picture">
    </div>

    <div class="rounded-top-5 p-8 shadow-md mt-5 p-2" style="background-color: #E5F4FB;">
        <h3 class="text-center fw-bold p-5">Create New Account</h3>

        <div class="d-flex justify-content-center mb-5">
            {{-- <div class="d-flex flex-column gap-3" style="width:30%"> --}}
            <form action="{{ route('auth.register') }}" method="POST" class="d-flex flex-column gap-3" style="width:30%">
                @csrf

                <input class="form-control form-control-lg" type="email" name="email" placeholder="E-mail" required>
                <input class="form-control form-control-lg" type="text" name="username" placeholder="Username" required>
                <input class="form-control form-control-lg" type="password" name="password" placeholder="Password">
                <input class="form-control form-control-lg" type="password" name="password_confirmation" placeholder="Confirm Password">

                {{-- <div class="btn-group">
                    <button class="btn dropdown-toggle bg-white" type="button" data-bs-toggle="dropdown"
                        data-bs-auto-close="true" aria-expanded="false">
                        Choose Currency
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">USD</a></li>
                        <li><a class="dropdown-item" href="#">Rp</a></li>
                        <li><a class="dropdown-item" href="#">JPY</a></li>
                        <li><a class="dropdown-item" href="#">CNY</a></li>
                        <li><a class="dropdown-item" href="#">KRW</a></li>
                    </ul>
                </div> --}}
                <select name="currency" class="form-select form-select-lg">
                    <option value="" disabled selected>Choose Currency</option>
                    <option value="USD">USD</option>
                    <option value="IDR">IDR</option>
                    <option value="JPY">JPY</option>
                    <option value="CNY">CNY</option>
                    <option value="KRW">KRW</option>
                </select>

                <div class="form-check d-flex justify-content-center gap-2">
                    <input class="form-check-input" type="checkbox" name="agree" required id="checkDefault">
                    <label class="form-check-label" for="checkDefault">
                        I agree to the terms and conditions
                    </label>
                </div>

                <div class="d-grid gap-2 col-6 mx-auto mt-3" style="width:100%">
                    {{-- <a href="{{ route('home') }}">
                        <button type="button" class="btn text-white w-100" style="background-color: #005CAB;">Register
                        </button>
                    </a> --}}
                    <button type="submit" class="btn text-white w-100" style="background-color: #005CAB;">
                        Register
                    </button>
                    @error('email')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                    @error('username')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                    @error('password')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                    @error('password_confirmation')
                        <small class="text-danger d-block">{{ $message }}</small>
                    @enderror
                </div>

            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0/dist/chart.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
        crossorigin="anonymous"></script>
</body>

</html>
