{{-- resources/views/buku/show.blade.php (contoh lengkap) --}}
@extends('layouts.app')

@section('title', ($buku->title ?? 'Buku tidak ditemukan') . ' — BookStore')

@section('content')
    @if ($buku)
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('images/img-buku.jpg') }}" class="img-fluid rounded" alt="Sampul {{ $buku->title }}">
            </div>
            <div class="col-md-8">
                <div class="d-flex gap-2">
                    <span class="badge bg-secondary align-self-start mb-2">{{ $buku->category->name }}</span>
                    @if ($buku->publisher)
                        <span class="badge bg-primary align-self-start mb-2">{{ $buku->publisher->name }}</span>
                    @endif
                </div>
                <h1>{{ $buku->title }}</h1>
                <p class="text-muted">Penulis: {{ $buku->author_name }}</p>
                <p class="harga-buku fs-4">Rp{{ number_format($buku->price, 0, ',', '.') }}</p>
                <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">&larr; Kembali ke daftar buku</a>
            </div>
        </div>
    @else
        ...{{-- bagian "buku tidak ditemukan", TIDAK berubah dari pertemuan sebelumnya --}}
    @endif
@endsection