@extends('layout.template')

@section('title', 'Categories')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('assets/css/categories.css') }}">
@endsection

@section('content')
<div class="container-fluid px-5 py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <h1 class="page-title">Categories</h1>
        <a href="{{ route('newcategory') }}" class="btn btn-primary btn-new-category text-white">
            + New Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">
        {{-- Expenses --}}
        <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="section-title mb-4">
                <a href="#">Expenses &gt;</a>
            </div>
            <div class="d-flex flex-wrap gap-3">
                @forelse($expenses as $category)
                    <div class="category-card position-relative">
                        <img src="{{ asset('assets/images/' . $category->icon) }}" alt="{{ $category->name }} Icon">
                        <span class="category-name" style="color: {{ $category->icon_color }}">{{ $category->name }}</span>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-2 py-0" onclick="return confirm('Are you sure?')">×</button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted">No expense categories yet.</p>
                @endforelse
            </div>
        </div>

        {{-- Income --}}
        <div class="col-lg-6">
            <div class="section-title mb-4">
                <a href="#">Income &gt;</a>
            </div>
            <div class="d-flex flex-wrap gap-3">
                @forelse($income as $category)
                    <div class="category-card position-relative">
                        <img src="{{ asset('assets/images/' . $category->icon) }}" alt="{{ $category->name }} Icon">
                        <span class="category-name" style="color: {{ $category->icon_color }}">{{ $category->name }}</span>
                        <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="position-absolute top-0 end-0 m-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger px-2 py-0" onclick="return confirm('Are you sure?')">×</button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted">No income categories yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
