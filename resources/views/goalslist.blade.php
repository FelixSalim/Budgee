@extends('layout.template')
@section('title', 'Goals List')
@section('content')
    <div class="container-fluid px-5 py-5">
        {{-- HEADER PAGE --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="page-title">Goals</h1>
            <a href="{{ route('newgoals') }}" class="btn btn-primary btn-new-goal text-white">
                + New Goal
            </a>
        </div>

        <div class="bg-white p-4 border shadow-sm mb-4">
            <h5 class="total-saved-title">Total Saved</h5>
            <h3 class="money-saved-title">IDR 20,000,000</h3>
        </div>

        <div class="row">
            @for ($i = 0; $i < 6; $i++)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            {{-- ICON + TITLE + MENU --}}
                            <h5 class="card-title fw-bold mb-3 d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ asset('assets/assetsGoals/tdesign_education-filled.svg') }}" alt="" class="me-3">
                                    Education
                                </div>
                                <div class="dropdown">
                                    <a href="#" class="d-flex align-items-center link-dark text-decoration-none" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ asset('assets/assetsGoals/mage_dots.svg') }}" alt="">
                                    </a>

                                    <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                        <li><a class="dropdown-item" href="#">Edit Goal</a></li>
                                        <li><a class="dropdown-item" href="#">Delete Goal</a></li>
                                    </ul>
                                </div>
                            </h5>

                            {{-- MONEY GOAL TEXT --}}
                            <p class="money-goal mb-1">IDR 25,000,000</p>

                            {{-- PROGRESS BAR --}}
                            <div class="progress mb-1" role="progressbar" aria-label="Example 20px high" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 5px">
                                <div class="progress-bar" style="width: 60%"></div>
                            </div>

                            {{-- MONEY SAVED TEXT --}}
                            <div class="d-flex justify-content-between align-items">
                                <p class="money-saved">IDR 15,000,000 <span class="saved-word">saved</span></p>
                                <p class="saved-word">60%</p>
                            </div>

                            {{-- LINE DIVIDER --}}
                            <hr class="mt-0">

                            {{-- CARD INFO --}}
                            <div class="card-info d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img class="me-2" src="{{ asset('assets/assetsGoals/calendar.svg') }}" alt="">
                                    <p class="card-date mb-0">Sept 01, 2025</p>
                                </div>
                                {{-- <button class="add-money-button">
                                    + Add Money
                                </button> --}}

                                {{-- DROPDOWN ADD MONEY --}}
                                <div class="position-relative">
                                    <button class="add-money-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                       + Add Money
                                    </button>

                                    <div class="dropdown-menu show-up p-3 shadow">
                                        <form>
                                            <div class="mb-2">
                                                <label for="amount" class="form-label">Add Amount</label>
                                                <input type="number" name="amount" class="form-control" placeholder="e.g. 1000000">
                                            </div>
                                            <button type="submit" class="btn btn-sm btn-success w-100">Submit</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            @endfor
        </div>
    </div>
@endsection
