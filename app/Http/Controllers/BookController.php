<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => ["judul" => "Laskar Pelangi", "penulis" => "Andrea Hirata", "harga" => 65000],
        2 => ["judul" => "Laut Bercerita dan Pulang", "penulis" => "Leila S. Chudori", "harga" => 85000],
        3 => ["judul" => "Supernova", "penulis" => "Dewi Lestari", "harga" => 72000],
    
    ];
    
    public function index()

    {
        return view("buku.index",["daftarBuku"=> $this->daftarBuku]);
    }
    public function show($id)
    {
        $buku = $this->daftarBuku[$id]?? null;
        return view("buku.show",["buku"=> $buku, "id" => $id]);
    }
}
