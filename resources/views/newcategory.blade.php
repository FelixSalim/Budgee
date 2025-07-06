@extends('layout.template')

@section('title', 'New Category')

@section('content')

<style>
    /* Menggunakan kembali style dari halaman Categories */
    .page-title {
        font-family: 'DM Sans', sans-serif;
        color: #005CAB;
        font-weight: 500;
        font-size: 2rem;
        margin-bottom: 0;
        padding-left: 1rem;
        text-decoration: none
    }

    /* Style untuk halaman New Category */
    .new-category-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 3rem;
    }

    .back-arrow-img {
        width: 13px;
        height: auto;
        transition: opacity 0.3s;
    }
    .back-arrow-img:hover {
        opacity: 0.8;
    }

    /* --- Preview Card --- */
    .preview-card {
        width: 150px;
        height: 150px;
        border: 2px solid #E0E0E0;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        text-align: center;
    }
    .preview-card img {
        width: 60px;
        height: 60px;
        margin-bottom: 0.75rem;
    }
    .preview-card .category-name-preview {
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        margin: 0;
        font-size: 1.1rem;
        color: #005CAB;
    }

    /* --- Form Input --- */
    .form-control-underline {
        border: none;
        border-bottom: 3.5px solid #005CAB;
        border-radius: 0;
        padding: 0.5rem 0;
        font-family: 'DM Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 500;
        color: #000000;
    }
    .form-control-underline:focus {
        box-shadow: none;
        border-color: #003F7F;
    }
    .form-control-underline::placeholder {
        color: #BDBDBD;
        font-weight: 400;
    }

    /* --- Custom Radio Button --- */
    .form-check-custom {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-check-custom .form-check-input {
        display: none;
    }
    .form-check-custom .form-check-label {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.2rem;
        cursor: pointer;
        position: relative;
        padding-left: 30px;
        color: #005CAB;
    }
    .form-check-custom .form-check-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 22px;
        height: 22px;
        border: 2px solid #005CAB;
        border-radius: 50%;
        background-color: #fff;
    }
    .form-check-custom .form-check-input:checked + .form-check-label::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background-color: #005CAB;
    }

    /* --- Section Styling --- */
    .section-heading {
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #005CAB;
    }

    .info-text {
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        color: #005CAB;
        font-size: 1.3rem
    }

    /* --- Icon & Color Chooser --- */
    .chooser-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.2rem;
    }
    .icon-box {
        width: 70px;
        height: 70px;
        border: 3px solid transparent;
        border-radius: 12px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: border-color 0.2s;
    }
    .icon-box img {
        width: 40px;
        height: 40px;
    }
    .icon-box.active {
        border-color: #005CAB;
    }

    .color-swatch {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        cursor: pointer;
        position: relative; /* Diperlukan untuk positioning ikon centang */
    }
    /* DIUBAH: Style untuk ikon centang dari gambar */
    .check-icon {
        display: none; /* Sembunyikan secara default */
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 24px; /* Sesuaikan ukuran ikon centang */
        height: 24px;
    }
    .color-swatch.active .check-icon {
        display: block; /* Tampilkan jika parent memiliki class active */
    }

    /* --- Final Button --- */
    .btn-add-category {
        background-color: #005CAB;
        border-color: #005CAB;
        border-radius: 12px;
        padding: 12px 30px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 500;
        font-size: 1.2rem;
        transition: background-color 0.3s;
    }
    .btn-add-category:hover {
        background-color: #003F7F;
    }
</style>

<div class="container-fluid px-5 py-5">
    <div class="new-category-header">
        <a href="{{ route('categories') }}">
            <img src="{{ asset('assets/images/leftarrow.png') }}" alt="Back" class="back-arrow-img">
        </a>
        <a class="page-title" href="{{route('categories')}}">New Category</a>
    </div>

    <div class="row">
        <div class="col-lg-9 col-xl-8">

            <div class="row align-items-center mb-5">
                <div class="col-md-4 d-flex justify-content-center mb-4 mb-md-0">
                    <div class="preview-card" id="previewCard">
                        <img src="{{ asset('assets/images/present.png') }}" alt="Present Icon" id="previewIcon">
                        <span class="category-name-preview" id="previewName" style="color: #AA0000;">Present</span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-4">
                        <input type="text" class="form-control form-control-underline" id="categoryName" placeholder="Category Name" value="Present">
                    </div>
                    <div class="d-flex gap-4">
                        <div class="form-check form-check-custom">
                            <input class="form-check-input" type="radio" name="categoryType" id="expensesRadio" checked>
                            <label class="form-check-label" for="expensesRadio">Expenses</label>
                        </div>
                        <div class="form-check form-check-custom">
                            <input class="form-check-input" type="radio" name="categoryType" id="incomeRadio">
                            <label class="form-check-label" for="incomeRadio">Income</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Planned Outlay</h2>
                <div class="d-flex align-items-end gap-3">
                    <div class="col-6 col-md-5 col-lg-4">
                        <input type="text" class="form-control form-control-underline" id="plannedOutlay" placeholder="Not set">
                    </div>
                    <span class="info-text">IDR per month</span>
                </div>
            </div>

            <div class="mb-5">
                <h2 class="section-heading">Icons</h2>
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

            <div class="mb-5">
                <h2 class="section-heading">Color</h2>
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
            </div>

            <div class="d-flex justify-content-end mt-4">
                <a href="#" class="btn btn-primary btn-add-category text-white">Add New Category</a>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- Elemen DOM ---
        const categoryNameInput = document.getElementById('categoryName');
        const previewNameSpan = document.getElementById('previewName');
        const previewIcon = document.getElementById('previewIcon');
        const iconBoxes = document.querySelectorAll('.icon-box');
        const colorSwatches = document.querySelectorAll('.color-swatch');

        // --- FUNGSI UNTUK MENGUBAH NAMA PREVIEW ---
        categoryNameInput.addEventListener('input', function() {
            const newName = categoryNameInput.value;
            previewNameSpan.textContent = newName ? newName : 'Category';
        });

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
