<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'kategori', // Ubah dari 'jurusan' menjadi 'kategori'
        'tanggal',
        'status',
        'gambar',
    ];
}