<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Galeri;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $query = Galeri::query();

        // Filter Kategori (jika ada)
        if ($request->has('kategori') && $request->kategori != '' && $request->kategori != 'semua') {
            $query->where('kategori', $request->kategori);
        }

        // Search Judul (jika ada)
        if ($request->has('search') && $request->search != '') {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $galeriList = $query->latest()->get();

        return view('admin.admin-galeri', compact('galeriList'));
    }

    public function create()
    {
        return view('admin.admin-galeri-tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string',
            'tanggal'  => 'required|date',
            'status'   => 'required|string',
            'gambar'   => 'required|image|mimes:jpeg,png,jpg,webp|max:10240', // Maksimal 10 MB
        ]);

        $file = $request->file('gambar');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('images/galeri'), $filename);

        Galeri::create([
            'judul'    => $request->judul,
            'kategori' => strtolower($request->kategori),
            'tanggal'  => $request->tanggal,
            'status'   => $request->status,
            'gambar'   => 'images/galeri/' . $filename,
        ]);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan!');
    }

    public function publicIndex()
    {
        $galeriList = Galeri::where('status', 'publik')->latest()->get();
        return view('galeri', compact('galeriList'));
    }

    public function edit($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.admin-galeri-edit', compact('galeri'));
    }

    public function update(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);

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
            if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
                @unlink(public_path($galeri->gambar));
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/galeri'), $filename);
            $data['gambar'] = 'images/galeri/' . $filename;
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $galeri = Galeri::findOrFail($id);

        if ($galeri->gambar && file_exists(public_path($galeri->gambar))) {
            @unlink(public_path($galeri->gambar));
        }

        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus!');
    }
}