<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'stok_masuk',
        'id_barang',
    ];
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
}
