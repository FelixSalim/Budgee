@extends('layout.template')
@section('title', 'Goals List')
@section('content')
<div class="container-fluid px-5 py-5">
    {{-- HEADER PAGE --}}
    <div class="new-goal-header">
        <a href="{{ route('goalslist') }}">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
        </a>
        <a class="page-title" href="">New Goal</a>
    </div>

    {{-- FORM --}}
    <form>
        {{-- NAME --}}
        <div class="mb-5">
          <label for="goalName" class="input-title form-label">Goal Name</label>
          <input type="text" class="input-box form-control w-50" id="goalName" placeholder="Enter your goal name">
        </div>
        {{-- DATE --}}
        <div class="mb-5">
            <label for="targetDate" class="input-title form-label">Target Date</label>
            <input type="date" class="input-box form-control w-50" id="targetDate">
        </div>
        {{-- TARGET SAVING --}}
        <div class="mb-5">
            <label for="goalAmount" class="input-title form-label">Goal Amount</label>
            <div class="d-flex align-items-center">
                <span class="input-title mb-0">IDR</span>
                <input type="text" class="input-box form-control ms-2 w-50" id="goalAmount">
            </div>
        </div>

        {{-- CHOOSE ICON --}}
        <div class="mb-5">
            <h2 class="input-title">Icons</h2>
            <div class="chooser-container">
                <div class="icon-box" data-icon-src="{{ asset('assets/images/foodbw.png') }}">
                    <img src="{{ asset('assets/images/foodbw.png') }}" alt="Food Icon">
                </div>
                <div class="icon-box active" data-icon-src="{{ asset('assets/images/presentbw.png') }}">
                    <img src="{{ asset('assets/images/presentbw.png') }}" alt="Present Icon">
                </div>
                <div class="icon-box" data-icon-src="{{ asset('assets/images/healthbw.png') }}">
                    <img src="{{ asset('assets/images/healthbw.png') }}" alt="Health Icon">
                </div>
                <div class="icon-box" data-icon-src="{{ asset('assets/images/paycheckbw.png') }}">
                    <img src="{{ asset('assets/images/paycheckbw.png') }}" alt="Paycheck Icon">
                </div>
                <div class="icon-box" data-icon-src="{{ asset('assets/images/edubw.png') }}">
                    <img src="{{ asset('assets/images/edubw.png') }}" alt="Education Icon">
                </div>
                <div class="icon-box" data-icon-src="{{ asset('assets/images/groceriesbw.png') }}">
                    <img src="{{ asset('assets/images/groceriesbw.png') }}" alt="Groceries Icon">
                </div>
                <div class="icon-box" data-icon-src="{{ asset('assets/images/intbw.png') }}">
                    <img src="{{ asset('assets/images/intbw.png') }}" alt="Interest Icon">
                </div>
            </div>
        </div>
        {{-- <div class="mb-5">
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
        </div> --}}

        {{-- CHOOSE COLOR --}}
        <div class="mb-5">
            <h2 class="input-title">Color</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="chooser-container">
                    {{-- DIUBAH: Menggunakan data-color dan ikon gambar --}}
                    <div class="color-swatch" data-color="#B9A400" style="background-color: #B9A400;">
                        <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                    </div>
                    <div class="color-swatch" data-color="#6C00AA" style="background-color: #6C00AA;">
                        <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                    </div>
                    <div class="color-swatch" data-color="#3B9201" style="background-color: #3B9201;">
                        <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                    </div>
                    <div class="color-swatch active" data-color="#AA0000" style="background-color: #AA0000;">
                        <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                    </div>
                    <div class="color-swatch" data-color="#AA007D" style="background-color: #AA007D;">
                        <img src="{{ asset('assets/images/check.png') }}" class="check-icon" alt="Selected">
                    </div>
                </div>
                {{-- ADD BUTTON --}}
                <div class="d-flex justify-content-end mt-4">
                    <a href="#" class="btn btn-primary btn-add-goal text-white">Add New Goal</a>
                </div>
            </div>
        </div>
        {{-- <div class="mb-5">
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
                        <span class="checkmark">&#10003;</span>
                    </label>
                @endforeach
                <img src="{{ asset('assets/assetsGoals/addIcon.svg') }}" alt="" class="add-color-btn">
            </div>
        </div> --}}

        {{-- ADD BUTTON
        <div class="d-flex justify-content-end mt-4">
            <a href="#" class="btn btn-primary btn-add-goal text-white">Add New Goal</a>
        </div> --}}
  </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- Elemen DOM ---
        const goalNameInput = document.getElementById('goalName');
        const previewNameSpan = document.getElementById('previewName');
        const previewIcon = document.getElementById('previewIcon');
        const iconBoxes = document.querySelectorAll('.icon-box');
        const colorSwatches = document.querySelectorAll('.color-swatch');

        // --- FUNGSI UNTUK MEMILIH IKON ---
        iconBoxes.forEach(box => {
            box.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua ikon
                iconBoxes.forEach(b => b.classList.remove('active'));
                // Tambahkan kelas 'active' ke ikon yang diklik
                this.classList.add('active');
                // Ubah gambar di preview
                const newIconSrc = this.dataset.iconSrc;
                if (newIconSrc) {
                    previewIcon.src = newIconSrc;
                }
            });
        });

        // --- FUNGSI UNTUK MEMILIH WARNA ---
        colorSwatches.forEach(swatch => {
            swatch.addEventListener('click', function() {
                // Hapus kelas 'active' dari semua warna
                colorSwatches.forEach(s => s.classList.remove('active'));
                // Tambahkan kelas 'active' ke warna yang diklik
                this.classList.add('active');
                // Ubah warna teks di preview menggunakan data-color
                const newColor = this.dataset.color;
                if (newColor) {
                    previewNameSpan.style.color = newColor;
                }
            });
        });
    });
</script>
@endsection
