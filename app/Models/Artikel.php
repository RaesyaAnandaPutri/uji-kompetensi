<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels';

    protected $fillable = [
        'judul',
        'kategori',
        'tanggal',
        'status',
        'gambar',
        'deskripsi', // <-- Tambahkan ini agar deskripsi mau tersimpan
    ];
}