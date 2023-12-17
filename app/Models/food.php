<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class food extends Model
{
    use HasFactory;
    protected $fillable=[
        'kode',
        'nama',
        'kelompok',
        'qty',
        'safetyStock',
        'hargaBeli',
        'hargaJual',
        'biayaPemesanan',
        'lifeTime',
    ];
}
