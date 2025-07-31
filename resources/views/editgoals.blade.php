@extends('layout.template')

@section('title', 'Edit Goal')

@section('content')
    @php
        $currency = Auth::user()->currency;
    @endphp

    <div class="container-fluid px-5 py-5">
        {{-- HEADER PAGE --}}
        <div class="new-goal-header">
            <a href="{{ route('goalslist') }}">
                <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
            </a>
            <a class="page-title" href="{{ route('goalslist') }}">Edit Goal</a>
        </div>

        {{-- FORM --}}
        <form action="{{ route('goals.update', $goal->id) }}" method="POST" id="goalForm">
            @csrf
            @method('PUT')

            {{-- NAME --}}
            <div class="mb-5">
                <label for="goalName" class="input-title form-label">Goal Name</label>
                <input type="text" class="input-box form-control w-50" id="goalName" name="goalName"
                    value="{{ old('goalName', $goal->name) }}" required>
            </div>

            {{-- DATE --}}
            <div class="mb-5">
                <label for="targetDate" class="input-title form-label">Target Date</label>
                <input type="date" class="input-box form-control w-50" id="targetDate" name="targetDate"
                    value="{{ old('targetDate', $goal->target_date) }}" min="{{ \Carbon\Carbon::now()->toDateString() }}"
                    required>
            </div>

            {{-- TARGET SAVING --}}
            <div class="mb-5">
                <label for="goalAmount" class="input-title form-label">Goal Amount</label>
                <div class="d-flex align-items-center">
                    <span class="input-title mb-0">{{ $currency }}</span>
                    <input type="number" class="input-box form-control ms-2 w-50" id="goalAmount" name="goalAmount"
                        value="{{ old('goalAmount', $goal->target_amount) }}" required>
                </div>
            </div>

            {{-- SUBMIT --}}
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-primary btn-add-goal text-white">Update Goal</button>
            </div>
        </form>
    </div>
@endsection