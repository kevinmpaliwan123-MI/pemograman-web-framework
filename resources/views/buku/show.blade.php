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

                @if ($buku->published_year)
                    <p class="text-muted">Tahun terbit: {{ $buku->published_year }}</p>
                @endif

                @if ($buku->stock > 0)
                    <p class="mb-3">Stok: {{ $buku->stock }}</p>
                @else
                    <p class="mb-3"><span class="badge bg-danger">Stok habis</span></p>
                @endif

                <div class="d-flex gap-2">
                    <a href="{{ url('/buku/' . $buku->id . '/edit') }}" class="btn btn-warning">Ubah</a>
                    <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">&larr; Kembali ke daftar buku</a>
                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Yakin menghapus buku ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        @if ($bukuSerupa->isNotEmpty())
            <h2 class="h5 mt-5">Buku lain di kategori {{ $buku->category->name }}</h2>
            <ul class="list-unstyled">
                @foreach ($bukuSerupa as $serupa)
                    <li>
                        <a href="{{ route('buku.show', $serupa->id) }}">{{ $serupa->title }}</a>
                        <span class="text-muted">— {{ $serupa->author_name }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <div class="alert alert-warning">
            Buku tidak ditemukan.
        </div>
        <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">&larr; Kembali ke daftar buku</a>
    @endif
    
@endsection