<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return view('buku.index', [
            'daftarBuku' => Book::with(['category', 'publisher'])->get(),
        ]);
    }

    public function show($id)
    {
        $buku = Book::with(['category', 'publisher'])->find($id);

        return view('buku.show', [
            'buku' => $buku,
            'id' => $id,
        ]);
    }
}
