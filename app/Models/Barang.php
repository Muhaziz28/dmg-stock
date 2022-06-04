<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'ukuran',
        'id_bahan',
        'id_variasi',
        'stok',
    ];

    public function variasi()
    {
        return $this->belongsTo(Variasi::class, 'id_variasi', 'id');
    }
    public function bahan()
    {
        return $this->belongsTo(Bahan::class, 'id_bahan', 'id');
    }
}
