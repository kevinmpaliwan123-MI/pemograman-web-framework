<?php

 namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        return view('author.index', [
            'daftarPenulis' => Author::withCount('books')->orderBy('writer')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'writer' => 'required|string|max:100|unique:authors,writer',
            'country' => 'nullable|string|max:100|min:4',
        ], [
            'writer.required' => 'Nama Penulis wajib diisi.',
            'writer.max'      => 'Nama penulis  maksimal 100 karakter.',
            'writer.unique'   => 'Nama penulis  ini sudah dipakai.',
            'country.max'      => 'Kabupaten/Kota penulis maksimal 100 karakter.',
            'country.min' => 'Negara Penulis Minimal 4'
        ]);

        Author::create($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('author.edit', [
            'author' => Author::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'writer' => [
                'required',
                'string',
                'max:100',
                Rule::unique('authors', 'writer')->ignore($author->id),
            ],
            'country' => 'nullable|string|max:100|min:4',
        ], [
            'writer.required' => 'Nama penulis wajib diisi.',
            'writer.max'      => 'Nama penulis maksimal 100 karakter.',
            'writer.unique'   => 'Nama penulis ini sudah dipakai.',
            'country.max'   => 'Negara penulis maksimal 100 karakter.',
            'country.min'   => 'Negara penulis minimal 4 karakter.',
        ]);

        $author->update($validated);

        return redirect()->route('penulis.index')
            ->with('success', 'Penulis berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = Author::findOrFail($id);

        try {
            $author->delete();
        } catch (QueryException $e) {
            if ($e->getCode() !== '23000') {
                throw $e;
            }

            return redirect()->route('penulis.index')
                ->with('error', 'penulis "' . $author->writer . '" tidak bisa dihapus karena masih dipakai oleh buku.');
        }

        return redirect()->route('penulis.index')
            ->with('success', 'penulis berhasil dihapus.');
    }
}
