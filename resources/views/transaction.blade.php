@extends('layout.template')
@section('title', 'Transactions')
@section('extra-css')
    <link rel="stylesheet" href="/assets/css/transaction.css">
@endsection
@section('content')
    <div class="container p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="page-title m-0 p-0">Transaction</h2>
            <a href="{{ route('newtransaction') }}"><button class="add-btn rounded-3">+ Add Transaction</button></a>
        </div>

        <div class="d-flex mb-4">
            <button class="toggle-btn w-50 fw-medium">Expenses</button>
            <button class="toggle-btn w-50 secondary fw-medium">Incomes</button>
        </div>

       <div class="row mt-4 mx-0 mb-0 p-4 transaction-history-container">
            <div class="d-flex flex-row justify-content-between align-items-center mb-3 p-0">
                <h2 class="transaction-history-title h2 my-2 mx-0 p-0">Transaction</h2>
                <p class="transaction-history-date p-0 m-0">01 June 2025</p>
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
            <p class="mx-0 my-2 p-0 total">Total: IDR 267,000</p>
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
                                    <p class="m-0 p-0">Tax</p>
                                </div>
                            </div>
                        </td>
                        <td>Pajak Gaji Bulan Juni</td>
                        <td>01-06-25</td>
                        <td class="amount-decrease">-IDR 217,000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection