<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtikelController extends Controller
{
    // ==========================================
    // HALAMAN PUBLIK (FRONTEND)
    // ==========================================

    /**
     * Menampilkan daftar artikel untuk pengunjung umum
     */
    public function publicIndex()
    {
        $artikels = Artikel::where('status', 'publik')->latest('tanggal')->get();

        return view('artikel', compact('artikels'));
    }

    /**
     * Menampilkan detail artikel berdasarkan ID
     */
    public function show($id)
    {
        $artikel = Artikel::findOrFail($id);

        return view('detail-artikel', compact('artikel'));
    }

    // ==========================================
    // HALAMAN ADMIN (BACKEND)
    // ==========================================

    public function index(Request $request)
    {
        $query = Artikel::query();

        // Filter Kategori
        if ($request->has('kategori') && $request->kategori != '' && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search Judul
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $artikels = $query->latest()->paginate(10);

        return view('admin.admin-artikel', compact('artikels'));
    }

    public function create()
    {
        return view('admin.admin-artikel-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar'    => 'required|image|mimes:jpeg,png,jpg,webp|max:10240', // Maksimal 10 MB
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string',
            'tanggal'   => 'required|date',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:publik,draft',
        ]);

        $imagePath = null;
        if ($request->hasFile('gambar')) {
            $imagePath = $request->file('gambar')->store('artikel', 'public');
        }

        Artikel::create([
            'gambar'    => $imagePath ? 'storage/' . $imagePath : null,
            'judul'     => $request->judul,
            'kategori'  => strtolower($request->kategori),
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $artikel = Artikel::findOrFail($id);
        return view('admin.admin-artikel-edit', compact('artikel'));
    }

    public function update(Request $request, $id)
    {
        $artikel = Artikel::findOrFail($id);

        $request->validate([
            'gambar'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240', // Maksimal 10 MB
            'judul'     => 'required|string|max:255',
            'kategori'  => 'required|string',
            'tanggal'   => 'required|date',
            'deskripsi' => 'nullable|string',
            'status'    => 'required|in:publik,draft',
        ]);

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
                @unlink(public_path($artikel->gambar));
            }

            $imagePath = $request->file('gambar')->store('artikel', 'public');
            $artikel->gambar = 'storage/' . $imagePath;
        }

        $artikel->update([
            'judul'     => $request->judul,
            'kategori'  => strtolower($request->kategori),
            'tanggal'   => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'status'    => $request->status,
            'gambar'    => $artikel->gambar
        ]);

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $artikel = Artikel::findOrFail($id);

        if ($artikel->gambar && file_exists(public_path($artikel->gambar))) {
            @unlink(public_path($artikel->gambar));
        }

        $artikel->delete();

        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus!');
    }
}