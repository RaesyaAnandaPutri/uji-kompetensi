<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;
use App\Models\Artikel;
use App\Models\Produk;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Hitung total data
        $totalGaleri = Galeri::count();
        $totalArtikel = Artikel::count();
        $totalProduk = Produk::count();

        // 2. Ambil data terbaru dari tiap model
        $galeriTerbaru = Galeri::latest()->take(3)->get()->map(function ($item) {
            return [
                'judul'    => $item->judul ?? $item->nama_galeri ?? 'Tanpa Judul',
                'gambar'   => $item->gambar,
                'badge'    => 'badge-galeri',
                'kategori' => 'Galeri',
                'tanggal'  => $item->created_at,
            ];
        });

        $artikelTerbaru = Artikel::latest()->take(3)->get()->map(function ($item) {
            return [
                'judul'    => $item->judul,
                'gambar'   => $item->gambar,
                'badge'    => 'badge-artikel',
                'kategori' => 'Artikel',
                'tanggal'  => $item->created_at,
            ];
        });

        $produkTerbaru = Produk::latest()->take(3)->get()->map(function ($item) {
            return [
                'judul'    => $item->nama_produk ?? $item->judul,
                'gambar'   => $item->gambar,
                'badge'    => 'badge-acara',
                'kategori' => 'Produk',
                'tanggal'  => $item->created_at,
            ];
        });

        // Gabungkan dan urutkan 5 konten paling baru
        $kontenTerbaru = $galeriTerbaru
            ->concat($artikelTerbaru)
            ->concat($produkTerbaru)
            ->sortByDesc('tanggal')
            ->take(5)
            ->values();

        // 3. Ringkasan per Jurusan (DIBETULKAN: Diambil dari model PRODUK)
        $ringkasanKategori = collect([
            (object)['kategori' => 'PPLG', 'jumlah' => Produk::whereIn('kategori', ['pplg', 'PPLG'])->count()],
            (object)['kategori' => 'TJKT', 'jumlah' => Produk::whereIn('kategori', ['tjkt', 'TJKT'])->count()],
            (object)['kategori' => 'TPFL', 'jumlah' => Produk::whereIn('kategori', ['tpfl', 'TPFL'])->count()],
            (object)['kategori' => 'TO',   'jumlah' => Produk::whereIn('kategori', ['to', 'TO'])->count()],
        ]);

        return view('admin.dashboard', compact(
            'totalGaleri',
            'totalArtikel',
            'totalProduk',
            'kontenTerbaru',
            'ringkasanKategori'
        ));
    }
}