<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frakturBeli extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeTransaksi',
        'kodeMakanan',
        'kodeSupplier',
        'qty',
        'harga',
        'total',
        'tanggal',
    ];
}
