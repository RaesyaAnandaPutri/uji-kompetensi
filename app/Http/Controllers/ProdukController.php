<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    // Menampilkan daftar produk di Admin
    public function index(Request $request)
    {
        $query = Produk::query();

        // Ambil parameter kategori (default 'semua')
        $kategori = strtolower($request->get('kategori', 'semua'));
        $search = $request->get('search');

        // Filter berdasarkan kategori jika bukan 'semua'
        if ($kategori != '' && $kategori != 'semua') {
            $query->where(function ($q) use ($kategori) {
                $q->where('kategori', $kategori)
                  ->orWhere('kategori', strtoupper($kategori));
            });
        }

        // Filter berdasarkan pencarian judul
        if (!empty($search)) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $produkList = $query->latest()->get();

        // Kirim variabel $kategori dan $search ke view
        return view('admin.admin-produk', compact('produkList', 'kategori', 'search'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('admin.admin-produk-tambah'); 
    }

    // Menyimpan produk baru
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'status'   => 'required|string',
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
        $file->move(public_path('images/produk'), $filename);

        Produk::create([
            'judul'    => $request->judul,
            'kategori' => strtolower($request->kategori),
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
            'gambar'   => 'images/produk/' . $filename,
        ]);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        return view('admin.admin-produk-edit', compact('produk'));
    }

    // Memperbarui produk
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'status'   => 'required|string',
            'gambar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = [
            'judul'    => $request->judul,
            'kategori' => strtolower($request->kategori),
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
        ];

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                @unlink(public_path($produk->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $file->move(public_path('images/produk'), $filename);
            $data['gambar'] = 'images/produk/' . $filename;
        }

        $produk->update($data);

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    // Menghapus produk
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        if ($produk->gambar && file_exists(public_path($produk->gambar))) {
            @unlink(public_path($produk->gambar));
        }
        $produk->delete();

        return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    // Menampilkan produk di halaman publik
    public function publicIndex(Request $request)
    {
        $query = Produk::where('status', 'publik');

        $kategori = strtolower($request->get('kategori', 'semua'));
        $search = $request->get('search');

        // Filter kategori/jurusan
        if ($kategori != '' && $kategori != 'semua') {
            $query->where('kategori', $kategori);
        }

        // Filter pencarian berdasarkan judul
        if (!empty($search)) {
            $query->where('judul', 'like', '%' . $search . '%');
        }

        $produks = $query->latest()->get();

        return view('produk', compact('produks', 'kategori', 'search'));
    }
}