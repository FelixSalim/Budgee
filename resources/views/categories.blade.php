@extends('layout.template')

@section('title', 'Categories')

@section('content')


<style>
    /* CSS Kustom untuk Halaman Categories - Sebaiknya diletakkan di file CSS utama */
    .page-title {
        font-family: 'DM Sans', sans-serif;
        color: #005CAB; /* Warna biru tua sesuai desain */
        font-weight: 500;
    }

    .section-title a {
        font-family: 'DM Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 500;
        color: #005CAB;
        text-decoration: none;
        transition: color 0.3s;
    }
    .section-title a:hover {
        color: #005CAB;
    }

    .btn-new-category {
        background-color: #005CAB;
        border-color: #005CAB;
        border-radius: 50px; /* Membuat corner radius menjadi pill */
        padding: 10px 20px;
        font-family: 'DM Sans', sans-serif;
        font-weight: 300;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 15px; /* Jarak antara ikon dan teks */
    }
    .btn-new-category:hover {
        background-color: #005CAB;
        border-color: #005CAB;
    }

    .category-card {
        width: 200px;
        height: 200px;
        border: 2px solid #E0E0E0;
        border-radius: 16px; /* Corner radius untuk card */
        box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 1rem;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
    }

    .category-card img {
        width: 80px;
        height: 70px;
        margin-bottom: 0.75rem;
    }

    .category-card {
        font-family: 'DM Sans', sans-serif;
        font-weight: 400;
        margin: 0;
        font-size: 1.2rem;
    }
</style>

<div class="container-fluid px-5 py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="page-title">Categories</h1>
        {{-- Tombol ini akan mengarah ke halaman/route untuk menambah kategori baru --}}
        <a href="{{route('newcategory')}}" class="btn btn-primary btn-new-category text-white">
            {{-- <i class="bi bi-plus-lg"></i> --}}
            + New Category
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="section-title mb-4">
                {{-- Link ini bisa mengarah ke halaman detail expenses --}}
                <a href="#">Expenses &gt;</a>
            </div>

            {{-- Daftar Kategori Expenses --}}
            <div class="d-flex flex-wrap gap-3">
                {{-- Contoh Card 1: Groceries --}}
                <div class="category-card">
                    {{-- Ganti src dengan path gambar ikon Anda --}}
                    <img src="{{ asset('assets\images\groceries.png') }}" alt="Groceries Icon">
                    <span class="category-name" style="color: #AA007D">Groceries</span>
                </div>

                {{-- Contoh Card 2: Health --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\health.png') }}" alt="Health Icon">
                    <span class="category-name" style="color: #60AA00">Health</span>
                </div>

                {{-- Contoh Card 3: Education --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\edu.png') }}" alt="Education Icon">
                    <span class="category-name" style="color: #4F00AA">Education</span>
                </div>

                {{-- Contoh Card 4: Food --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\food.png') }}" alt="Food Icon">
                    <span class="category-name" style="color: #AA9900">Food</span>
                </div>

                {{-- Contoh Card 5: Present --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\present.png') }}" alt="Present Icon">
                    <span class="category-name" style="color: #AA0000">Present</span>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="section-title mb-4">
                {{-- Link ini bisa mengarah ke halaman detail income --}}
                <a href="#">Income &gt;</a>
            </div>

            {{-- Daftar Kategori Income --}}
            <div class="d-flex flex-wrap gap-3">
                {{-- Contoh Card 1: Interest --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\int.png') }}" alt="Interest Icon">
                    <span class="category-name" style="color: #AA9900">Interest</span>
                </div>

                {{-- Contoh Card 2: Paycheck --}}
                <div class="category-card">
                    <img src="{{ asset('assets\images\paycheck.png') }}" alt="Paycheck Icon">
                    <span class="category-name" style="color: #60AA00">Paycheck</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


{{-- ubah agar
- text groceries -> color: #AA007D
- text health -> color: #60AA00
- text food -> color: #AA9900
- text education -> color: #4F00AA
- text present -> color: #AA0000
- text interest -> color: #AA9900
- text paycheck -> color: #60AA00 --}}
