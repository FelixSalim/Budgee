@extends('layout.template')
@section('title', 'New Regular Payment')
@section('content')
<div class="container mt-5 ms-5" style="max-width: 700px;">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ url()->previous() }}" class="me-3 text-decoration-none text-primary fs-4">
            &#8592;
        </a>
        <h4 class="m-0" style="color: rgb(0, 92, 171)">New Regular Payment</h4>
    </div>

    <div class="card border-0 shadow-sm p-4">
        <form action="" method="POST">
            @csrf

            <div class="row mb-4 align-items-center">
                <div class="col-auto">
                    <div class="p-3 bg-white shadow-sm rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                    </div>
                </div>
                <div class="col">
                    <input type="text" name="transaction" class="form-control border-0 border-bottom border-primary rounded-0 shadow-none" placeholder="Regular Payment Name" required>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col">
                    <label class="form-label text-muted">Amount</label>
                    <div class="input-group border-bottom border-primary">
                        <span class="input-group-text bg-white border-0 shadow-none text-muted">Rp</span>
                        <input type="number" name="amount" class="form-control border-0 shadow-none" placeholder="100,000">
                    </div>
                </div>
                <div class="col">
                    <label class="form-label text-muted">Due Date</label>
                    <select name="due_date" class="form-select border-0 border-bottom border-primary rounded-0 shadow-none">
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}" {{ $i == 1 ? 'selected' : '' }}>Every {{ $i }}th</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill" style="background-color: rgb(0, 92, 171)">
                    Add Regular Payment
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
