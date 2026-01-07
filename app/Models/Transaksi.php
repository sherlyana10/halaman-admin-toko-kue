<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
   use HasFactory;

    protected $fillable = [
        'pelanggan_id',
        'tanggal',
        'total_harga',
        'status',
    ];

    // Relasi ke Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    // Relasi ke Produk (bisa nanti via pivot tabel transaksi_produk)
    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'transaksi_produk')
                    ->withPivot('jumlah', 'harga')
                    ->withTimestamps();
    }
}
