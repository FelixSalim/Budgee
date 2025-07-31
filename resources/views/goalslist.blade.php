@extends('layout.template')

@section('title', 'Goals List')

@section('content')
    @php
        $currency = Auth::user()->currency;
    @endphp

    <div class="container-fluid px-5 py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="page-title">Goals</h1>
            <a href="{{ route('newgoals') }}" class="btn btn-primary btn-new-goal text-white">+ New Goal</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="bg-white p-4 border shadow-sm mb-4">
            <h5 class="total-saved-title">Total Saved</h5>
            <h3 class="money-saved-title">{{ $currency }} {{ number_format($totalSaved ?? 0, 0, ',', '.') }}</h3>
        </div>

        <div class="row">
            @foreach ($goals as $goal)
                @php
                    $progress = ($goal->target_amount > 0) ? min(100, round(($goal->current_amount / $goal->target_amount) * 100)) : 0;
                @endphp
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3 d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('assets/images/' . $goal->icon) }}" class="me-2" alt="Icon" width="20"
                                        height="20" style="filter: drop-shadow(0 0 0 {{ $goal->color }});">
                                    {{ $goal->name }}
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none"
                                        id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/assetsGoals/mage_dots.svg') }}" alt="">
                                    </a>
                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('goals.edit', $goal->id) }}">Edit Goal</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('goals.delete', $goal->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">Delete Goal</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </h5>

                            <p class="money-goal mb-1">{{ $currency }} {{ number_format($goal->target_amount, 0, ',', '.') }}
                            </p>

                            <div class="progress mb-1" style="height: 5px">
                                <div class="progress-bar" style="width: {{ $progress }}%"></div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="money-saved">
                                    {{ $currency }} {{ number_format($goal->current_amount, 0, ',', '.') }}
                                    <span class="saved-word">saved</span>
                                </p>
                                <p class="saved-word">{{ $progress }}%</p>
                            </div>

                            <hr class="mt-0">

                            <div class="card-info d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img class="me-2" src="{{ asset('assets/assetsGoals/calendar.svg') }}" alt="">
                                    <p class="card-date mb-0">
                                        {{ \Carbon\Carbon::parse($goal->target_date)->format('M d, Y') }}
                                    </p>
                                </div>

                                <div class="position-relative">
                                    <button class="add-money-button" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        + Add Money
                                    </button>
                                    <div class="dropdown-menu show-up p-3 shadow">
                                        <form action="{{ route('goals.addMoney', $goal->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-2">
                                                <label for="amount" class="form-label">Add Amount</label>
                                                <input type="number" name="amount" class="form-control"
                                                    placeholder="e.g. {{ $currency }} 1000000" required>
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100">Submit</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection