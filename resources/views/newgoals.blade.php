@extends('layout.template')
@section('title', 'Goals List')
@section('content')
    {{-- HEADER PAGE --}}
    <div class="d-flex align-items-center mb-4">
        <img class="me-2" src="{{ asset('assets/assetsGoals/back.svg') }}" alt="">
        <h2 class="new-goal-text ms-5 mb-0">New Goal</h2>
    </div>

    {{-- FORM --}}
    <form>
        {{-- NAME --}}
        <div class="mb-3">
          <label for="goalName" class="input-title form-label">Goal Name</label>
          <input type="text" class="input-box form-control w-50" id="goalName" placeholder="Enter your goal name">
        </div>
        {{-- DATE --}}
        <div class="mb-3">
            <label for="targetDate" class="input-title form-label">Target Date</label>
            <input type="date" class="input-box form-control w-50" id="targetDate">
        </div>
        {{-- TARGET SAVING --}}
        <div class="mb-3">
            <label for="goalAmount" class="input-title form-label">Goal Amount</label>
            <div class="d-flex align-items-center">
                <span class="input-title mb-0">IDR</span>
                <input type="text" class="input-box form-control ms-2 w-50" id="goalAmount">
            </div>
        </div>
        {{-- CHOOSE ICON --}}
        <div class="mb-3">
            <label for="icon" class="input-title form-label">Icons</label>
            <div class="d-flex gap-3 flex-wrap mb-4 icon-select-group align-items-center">
                @php
                    $icons = [
                        'food' => 'food.svg',
                        'gift' => 'present.svg',
                        'health' => 'health.svg',
                        'saving' => 'invest.svg',
                        'education' => 'education.svg',
                        'shopping' => 'shopping.svg',
                        'money' => 'money.svg',
                    ];
                @endphp

                @foreach ($icons as $key => $file)
                    <label class="icon-option">
                        <input type="radio" name="icon" value="{{ $key }}" class="d-none">
                        <img src="{{ asset('assets/assetsGoals/' .$file) }}" alt="{{ $key }}" class="icon-img">
                    </label>
                @endforeach
                <img src="{{ asset('assets/assetsGoals/addIcon.svg') }}" alt="" class="add-icon-btn">
            </div>
        </div>

        {{-- CHOOSE COLOR --}}
        <div class="mb-3">
            <label for="color" class="input-title form-label">Color</label>
            <div class="d-flex gap-3 flex-wrap color-select-group">
                @php
                    $colors = [
                        'mustard' => '#AA9900',
                        'purple' => '#4F00AA',
                        'green' => '#60AA00',
                        'red' => '#AA0000',
                        'magenta' => '#AA007D',
                    ];
                @endphp

                @foreach($colors as $key => $hex)
                    <label class="color-option" style="background-color: {{ $hex }};">
                        <input type="radio" name="color" value="{{ $key }}" class="d-none">
                        <span class="checkmark">&#10003;</span> {{-- ✓ --}}
                    </label>
                @endforeach
                <img src="{{ asset('assets/assetsGoals/addIcon.svg') }}" alt="" class="add-color-btn">
            </div>
        </div>
        {{-- ADD BUTTON --}}
        <button type="submit" class="add-goal-btn ">Add New Goal</button>
      </form>
@endsection
