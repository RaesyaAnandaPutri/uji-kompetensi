<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesan;

class PesanController extends Controller
{
    // PUBLIK: terima kiriman dari form di halaman home
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:100',
            'email'     => 'required|email|max:255',
            'rating'    => 'required|integer|between:1,5',
            'isi_pesan' => 'required|string|min:10|max:2000',
        ], [
            'rating.required' => 'Silakan beri rating bintang 1 sampai 5.',
        ]);

        Pesan::create($validated);

        return redirect(route('home') . '#kontak')
            ->with('success', 'Terima kasih! Pesan Anda berhasil dikirim.');
    }

    // ADMIN: daftar pesan
    public function index(Request $request)
    {
        $query = Pesan::query();

        if ($request->status === 'belum') {
            $query->where('is_read', false);
        } elseif ($request->status === 'dibaca') {
            $query->where('is_read', true);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $pesanList   = $query->latest()->paginate(10)->withQueryString();
        $rataRating  = Pesan::whereNotNull('rating')->avg('rating');
        $totalRating = Pesan::whereNotNull('rating')->count();

        return view('admin.admin-pesan', compact('pesanList', 'rataRating', 'totalRating'));
    }

    // ADMIN: baca detail (otomatis ditandai sudah dibaca)
    public function show($id)
    {
        $pesan = Pesan::findOrFail($id);

        if (!$pesan->is_read) {
            $pesan->update(['is_read' => true]);
        }

        return view('admin.admin-pesan-detail', compact('pesan'));
    }

       // ADMIN: ganti status dibaca / belum dibaca
    public function toggleRead($id)
    {
        $pesan = Pesan::findOrFail($id);
        $pesan->update(['is_read' => !$pesan->is_read]);

        $status = $pesan->is_read ? 'sudah dibaca' : 'belum dibaca';

        return redirect()->route('admin.pesan.index')
            ->with('success', "Pesan ditandai {$status}.");
    }

    // ADMIN: hapus pesan
    public function destroy($id)
    {
        Pesan::findOrFail($id)->delete();

        return redirect()->route('admin.pesan.index')->with('success', 'Pesan berhasil dihapus!');
    }
}