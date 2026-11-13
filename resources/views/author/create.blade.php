@extends('layouts.app')

@section('title', 'Tambah Penulis — BookStore')

@section('content')
    <h1 class="mb-4">Tambah Penulis</h1>

    <form action="{{ route('penulis.store') }}" method="POST" style="max-width: 480px;">
        @csrf

        <div class="mb-3">
            <label for="writer" class="form-label">Nama Penulis</label>
            <input type="text" id="writer" name="writer"
                   class="form-control @error('writer') is-invalid @enderror"
                   value="{{ old('writer') }}">
            @error('writer')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Negara</label>
            <input type="text" id="country" name="country"
                   class="form-control @error('country') is-invalid @enderror"
                   value="{{ old('country') }}">
            @error('country')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('penulis.index') }}" class="btn btn-outline-secondary">Batal</a>
    </form>
@endsection