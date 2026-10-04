<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'isi_pesan',
        'rating',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}