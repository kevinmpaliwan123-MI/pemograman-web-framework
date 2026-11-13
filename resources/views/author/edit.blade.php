@extends('layouts.app')

@section('title', 'Ubah Penulis — BookStore')

@section('content')
    <h1 class="mb-4">Ubah Penulis</h1>

    <form action="{{ route('penulis.update', $author->id) }}" method="POST" style="max-width: 480px;">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="writer" class="form-label">Nama Penulis</label>
            <input type="text" id="writer" name="writer"
                   class="form-control @error('writer') is-invalid @enderror"
                   value="{{ old('writer', $author->writer) }}">
            @error('writer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Negara</label>
            <input type="text" id="country" name="country"
                   class="form-control @error('country') is-invalid @enderror"
                   value="{{ old('country', $author->country) }}">
            @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penulis.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
@endsection