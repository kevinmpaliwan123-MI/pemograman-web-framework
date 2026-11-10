@extends('layouts.app')

@section('title', 'Tambah Buku — BookStore')

@section('content')
    <h1 class="mb-4">Tambah Buku</h1>

    <form action="{{ url('/buku') }}" method="POST" enctype="multipart/form-data" style="max-width: 600px;">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author_name" class="form-label">Nama Penulis</label>
            <input type="text" id="author_name" name="author_name"
                class="form-control @error('author_name') is-invalid @enderror" value="{{ old('author_name') }}">
            @error('author_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                <option value="">-- Pilih Kategori --</option>
                @foreach ($daftarKategori as $kategori)
                    <option value="{{ $kategori->id }}" @selected(old('category_id') == $kategori->id)>{{ $kategori->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="publisher_id" class="form-label">Penerbit</label>
            <select id="publisher_id" name="publisher_id" class="form-select @error('publisher_id') is-invalid @enderror">
                <option value="">-- Pilih Penerbit --</option>
                @foreach ($daftarPenerbit as $penerbit)
                    <option value="{{ $penerbit->id }}" @selected(old('publisher_id') == $penerbit->id)>{{ $penerbit->name }}</option>
                @endforeach
            </select>
            @error('publisher_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Harga (Rp)</label>
            <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price') }}">
            <div class="form-text">Ketik angka saja, tanpa titik atau koma (contoh: 85000).</div>
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="text" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror"
                value="{{ old('stock', 0) }}">
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="published_year" class="form-label">Tahun Terbit (opsional)</label>
            <input type="text" id="published_year" name="published_year"
                class="form-control @error('published_year') is-invalid @enderror" value="{{ old('published_year') }}">
            @error('published_year')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cover" class="form-label">Sampul (opsional, JPG/PNG, maksimal 2 MB)</label>
            <input type="file" id="cover" name="cover" class="form-control @error('cover') is-invalid @enderror" accept="image/*">
            @error('cover')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- Pratinjau Sampul yang Dipilih -->
            <div id="preview-wrapper" class="mt-3" style="display: none;">
                <p class="small text-muted mb-1">Pratinjau Sampul:</p>
                <img id="cover-preview" src="#" alt="Pratinjau Sampul" class="img-thumbnail" style="max-height: 200px; max-width: 100%; object-fit: contain;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">Batal</a>
    </form>

    <script>
        document.getElementById('cover').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('cover-preview');
            const wrapper = document.getElementById('preview-wrapper');

            if (file) {
                preview.src = URL.createObjectURL(file);
                wrapper.style.display = 'block';
            } else {
                preview.src = '#';
                wrapper.style.display = 'none';
            }
        });
    </script>
@endsection