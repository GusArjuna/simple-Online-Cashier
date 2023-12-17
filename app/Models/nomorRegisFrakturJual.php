<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nomorRegisFrakturJual extends Model
{
    use HasFactory;
    protected $fillable=[
        'kode',
        'total',
        'kodeMember',
        'tanggal',
    ];
}
