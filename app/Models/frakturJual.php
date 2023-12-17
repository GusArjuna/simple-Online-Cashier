<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class frakturJual extends Model
{
    use HasFactory;
    protected $fillable=[
        'kodeTransaksi',
        'kodeMakanan',
        'kodeMember',
        'qty',
        'harga',
        'total',
        'tanggal',
    ];
}
