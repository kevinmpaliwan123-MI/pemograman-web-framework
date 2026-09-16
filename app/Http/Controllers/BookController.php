<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    private array $daftarBuku = [
        1 => ["judul" => "Laskar Pelangi", "penulis" => "Andrea Hirata"],
        2 => ["judul" => "Laut Bercerita dan Pulang", "penulis" => "Leila S. Chudori"],
        3 => ["judul" => " Supernova", "penulis" => "Dewi Lestari"],
    
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
