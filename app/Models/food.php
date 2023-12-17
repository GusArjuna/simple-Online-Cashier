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
        'foodCategory',
        'qty',
        'safetyStock',
        'hargaBeli',
        'hargaJual',
        'biayaPemesanan',
        'lifeTime',
        'keterangan',
        'penjualan',
    ];
    protected $attributes =[
        'penjualan' => 0,
    ];
}
