@extends('layout.template')
@section('title', 'Regular Payment')
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary rounded-pill px-4">
            + New Regular Payment
        </button>
    </div>

    <div class="card shadow-sm" style="border-radius: 1rem; width: 90%;">
        <div class="card-body">
            <h4 class="card-title mb-4">Regular Payment</h4>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Transaction</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Due Date</th>
                            <th>Time Left to Pay</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            <td>
                                <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                                Spotify
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto">
                                    <option value="paid" {{ (isset($status) && $status == 'paid') ? 'selected' : '' }}>PAID</option>
                                    <option value="unpaid" {{ (isset($status) && $status == 'unpaid') ? 'selected' : '' }}>UNPAID</option>
                                </select>
                            </td>
                            <td><strong>IDR 13,000</strong></td>
                            <td>Every 16th day</td>
                            <td>02 day(s) 14 hour(s)</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Icon">
                                </button>
                            </td>
                        </tr>

                        <!-- Row 2 -->
                        <tr>
                            <td>
                                <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                                Spotify
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto">
                                    <option value="paid" {{ (isset($status) && $status == 'paid') ? 'selected' : '' }}>PAID</option>
                                    <option value="unpaid" {{ (isset($status) && $status == 'unpaid') ? 'selected' : '' }}>UNPAID</option>
                                </select>
                            </td>
                            <td><strong>IDR 13,000</strong></td>
                            <td>Every 16th day</td>
                            <td>02 day(s) 14 hour(s)</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Icon">
                                </button>
                            </td>
                        </tr>

                        <!-- Row 3 (Editable) -->
                        <tr>
                            <td>
                                <img src="{{ asset('assets/icons/music-note-beamed.svg') }}" class="me-2" alt="Icon">
                                <span>Spotify</span>
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto">
                                    <option value="paid" {{ (isset($status) && $status == 'paid') ? 'selected' : '' }}>PAID</option>
                                    <option value="unpaid" {{ (isset($status) && $status == 'unpaid') ? 'selected' : '' }}>UNPAID</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" value="IDR 13,000">
                            </td>
                            <td>
                                <select class="form-select form-select-sm w-auto">
                                    @for ($i = 1; $i <= 31; $i++)
                                        <option value="{{ $i }}" {{ $i == 16 ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>02 day(s) 14 hour(s)</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-danger me-1 text-danger">
                                    <img src="{{ asset('assets/icons/trash.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-secondary me-1">
                                    <img src="{{ asset('assets/icons/pencil.svg') }}" alt="Icon">
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <img src="{{ asset('assets/icons/check.svg') }}" alt="Icon">
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
