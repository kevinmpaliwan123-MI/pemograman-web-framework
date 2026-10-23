<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penerbit.index', [
            'daftarPenerbit' => Publisher::withCount('books')->orderBy('name')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:publishers,name',
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max'      => 'Nama penerbit maksimal 100 karakter.',
            'name.unique'   => 'Nama penerbit ini sudah dipakai.',
            'city.required' => 'Kabupaten/Kota penerbit wajib diisi.',
            'city.max'      => 'Kabupaten/Kota penerbit maksimal 100 karakter.',
        ]);

        Publisher::create($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('penerbit.edit', [
            'penerbit' => Publisher::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('publishers', 'name')->ignore($penerbit->id),
            ],
            'city' => 'required|string|max:100',
        ], [
            'name.required' => 'Nama penerbit wajib diisi.',
            'name.max'      => 'Nama penerbit maksimal 100 karakter.',
            'name.unique'   => 'Nama penerbit ini sudah dipakai.',
            'city.required' => 'Kabupaten/Kota penerbit wajib diisi.',
            'city.max'      => 'Kabupaten/Kota penerbit maksimal 100 karakter.',
        ]);

        $penerbit->update($validated);

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penerbit = Publisher::findOrFail($id);

        try {
            $penerbit->delete();
        } catch (QueryException $e) {
            if ($e->getCode() !== '23000') {
                throw $e;
            }

            return redirect()->route('penerbit.index')
                ->with('error', 'Penerbit "' . $penerbit->name . '" tidak bisa dihapus karena masih dipakai oleh buku.');
        }

        return redirect()->route('penerbit.index')
            ->with('success', 'Penerbit berhasil dihapus.');
    }
}
