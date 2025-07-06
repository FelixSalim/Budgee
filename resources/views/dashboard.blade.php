@extends('layout.template')
@section('title', 'Dashboard')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection
@section('content')
    <div class="row p-3 m-3 title-section">
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
    <div class="row d-flex flex-row mx-3">
        <div class="col-7">
            <div class="row mb-4 mt-0 mx-0 px-4 py-3 balance-container">
                <h1 class="balance-title my-2 mx-0 p-0">
                    Current Balance
                </h1>
                <div class="row my-1 mx-0 p-0 d-flex flex-row align-items-center justify-content-between">
                    {{-- Database --}}
                    <div class="m-0 p-0" style="width: auto;">
                        <h1 class="balance m-0 p-0">
                            IDR 10,000,000
                        </h1>
                    </div>
                    <div class="m-0 p-0 d-flex flex-row" style="width: auto;">
                        <div class="me-3 ms-0 my-0 p-0">
                            <button class="btn add-button">
                                + Add
                            </button>
                        </div>
                        <div class="ms-2 me-0 my-0 p-0">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle month-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Month
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-0 mt-4 mb-1 pt-3 pb-0 px-0">
                    <div class="col m-0 p-0">
                        <div class="d-flex income-container align-items-center m-0">
                            <img src="{{ asset('assets/icons/incomes-icon.png') }}" alt="" width="35" height="35">
                            <div class="income-details mx-3">
                                <p class="income-title mx-0 my-1 p-0">Incomes</p>
                                <p class="income mx-0 my-1 p-0">IDR 4,000,000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col ms-4 me-0 my-0 p-0">
                        <div class="d-flex expense-container align-items-center m-0">
                            <img src="{{ asset('assets/icons/expenses-icon.png') }}" alt="" width="35" height="35">
                            <div class="expense-details mx-3">
                                <p class="expense-title mx-0 my-1 p-0">Expenses</p>
                                <p class="expense mx-0 my-1 p-0">IDR 2,000,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mx-0 mb-0 p-4 transaction-history-container">
                <h1 class="transaction-history-title h1 my-2 mx-0 p-0">Recent Cash Flow</h1>
                <table class="table table-hover mt-3">
                    <thead class="table-head">
                        <tr>
                            <th scope="col">Categories</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Date</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="py-3">
                                <div class="row d-flex align-items-center m-0 p-0">
                                    <div class="col-3 d-flex justify-content-center align-items-center me-2 ms-0 my-0 icon-container food-icon">
                                        <img src="{{ asset('assets/icons/food-icon.png') }}" alt="Food Icon" class="m-0 p-0">
                                    </div>
                                    <div class="col m-0 p-0">
                                        <p class="m-0 p-0">Food</p>
                                    </div>
                                </div>
                            </td>
                            <td>Ayam Mba Sri</td>
                            <td>01-06-25</td>
                            <td class="amount-decrease">-IDR 50,000</td>
                        </tr>
                        <tr>
                            <td class="py-3">
                                <div class="row d-flex align-items-center m-0 p-0">
                                    <div class="col-3 d-flex justify-content-center align-items-center me-2 ms-0 my-0 icon-container paycheck-icon">
                                        <img src="{{ asset('assets/icons/paycheck-icon.png') }}" alt="Paycheck Icon" class="m-0 p-0">
                                    </div>
                                    <div class="col m-0 p-0">
                                        <p class="m-0 p-0">Paycheck</p>
                                    </div>
                                </div>
                            </td>
                            <td>Gaji Bulan Juni</td>
                            <td>01-06-25</td>
                            <td class="amount-increase">+IDR 4,000,000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-5">
            <div class="d-flex flex-column m-0 p-0 category-container">
                <div class="row m-0 d-flex flex-row align-items-center justify-content-between category-title-container">
                    {{-- Database --}}
                    <div class="m-0 p-0" style="width: auto;">
                        <h1 class="category-title m-0 p-0">
                            Categories
                        </h1>
                    </div>
                    <div class="m-0 p-0 d-flex flex-row" style="width: auto;">
                        <div class="m-0 p-0">
                            <div class="dropdown">
                                <button class="btn dropdown-toggle month-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Month
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row income-expense-selector d-flex justify-content-evenly my-3 mx-0 p-0">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="#" class="active-selector">Expenses</a>
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <a href="#">Incomes</a>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <a href="#">
                        <img src="{{ asset('assets/icons/left-icon.png') }}" alt="">
                    </a>
                    <p class="month-category">January</p>
                    <a href="#">
                        <img src="{{ asset('assets/icons/right-icon.png') }}" alt="">
                    </a>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <canvas id="chart" class="m-0 p-0" width="250" height="250"></canvas>
                    <div class="position-absolute">
                        <p class="total m-0 p-0">
                            IDR 1.3M
                        </p>
                        <p class="total-title m-0 p-0">
                            Total Expense
                        </p>
                    </div>
                </div>
                <div class="legends my-3 mx-0 px-5 py-0 d-flex flex-column">
                    <div class="d-flex flex-row align-items-center justify-content-between mx-0 my-1 p-0 legend-items">
                        <div class="m-0 p-0 icon-container food-icon">
                            <img src="{{ asset('assets/icons/food-icon.png') }}" alt="">
                        </div>
                        <p class="mx-2 my-0 p-0 w-25">Food</p>
                        <p class="mx-2 my-0 p-0">50%</p>
                        <p class="mx-2 my-0 p-0">IDR 650,000</p>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between mx-0 my-1 p-0 legend-items">
                        <div class="m-0 p-0 icon-container groceries-icon">
                            <img src="{{ asset('assets/icons/groceries-icon.png') }}" alt="">
                        </div>
                        <p class="mx-2 my-0 p-0 w-25">Groceries</p>
                        <p class="mx-2 my-0 p-0">35%</p>
                        <p class="mx-2 my-0 p-0">IDR 455,000</p>
                    </div>
                    <div class="d-flex flex-row align-items-center justify-content-between mx-0 my-1 p-0 legend-items">
                        <div class="m-0 p-0 icon-container education-icon">
                            <img src="{{ asset('assets/icons/education-icon.png') }}" alt="">
                        </div>
                        <p class="mx-2 my-0 p-0 w-25">Education</p>
                        <p class="mx-2 my-0 p-0">15%</p>
                        <p class="mx-2 my-0 p-0">IDR 195,000</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('extra-script')
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection