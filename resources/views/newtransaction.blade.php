@extends('layout.template')
@section('title', 'Add Transaction')
@section('extra-css')
    <link rel="stylesheet" href="{{ asset('assets/css/newtransaction.css') }}">
@endsection
@section('content')
    <div class="container py-5 px-4">
        <div class="top-bar">
            <h4><a href="{{ url()->previous() }}"><i class="bi bi-arrow-left me-2"></i></a> Add Transaction</h4>
            <button class="btn-today d-flex justify-content-center align-items-center"><img width="30" height="30" src="{{ asset('assets/images/date-icon.png') }}" class="mx-2">Today</button>
        </div>

        <form>
            <div class="mb-5">
                <div class="d-flex align-items-center gap-3">
                    <input type="text" class="custom-input w-25" placeholder="0">
                    <span class="fw-medium text-primary">IDR</span>
                    <div class="form-check form-check-inline mx-5 ps-5">
                        <input class="form-check-input me-2" type="radio" name="type" id="expense" value="expense" checked>
                        <label class="form-check-label" for="expense">Expenses</label>
                    </div>
                    <div class="form-check form-check-inline mx-3">
                        <input class="form-check-input me-2" type="radio" name="type" id="income" value="income">
                        <label class="form-check-label" for="income">Income</label>
                    </div>
                </div>
            </div>
            <div class="form-section my-5">
                <label class="form-label my-3">Expense Categories</label>
                <div class="category-grid mt-2">
                    @foreach(['Groceries' => 'groceries.png', 'Health' => 'health.png', 'Food' => 'food.png', 'Education' => 'edu.png', 'Present' => 'present.png'] as $label => $icon)
                        <div class="category-box">
                            <img src="/assets/images/{{ $icon }}" alt="{{ $label }}">
                            <div class="category-label">{{ $label }}</div>
                        </div>
                    @endforeach
                    <div class="category-box text-muted">
                        <div class="fs-2">+</div>
                        <div class="category-label">New Category</div>
                    </div>
                </div>
            </div>

            <div class="form-section my-5">
                <label for="desc" class="form-label my-3">Description</label>
                <input type="text" id="desc" class="custom-input" placeholder="Description">
            </div>

            <div class="d-flex w-100 justify-content-center mt-5">
                <button type="submit" class="btn btn-primary rounded-4 mt-3">Add Transaction</button>
            </div>
        </form>
    </div>
@endsection