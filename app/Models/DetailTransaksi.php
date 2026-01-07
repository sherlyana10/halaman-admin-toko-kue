<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
     use HasFactory;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'kue_id',
        'qty',
        'subtotal',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function kue()
    {
        return $this->belongsTo(Produk::class, 'kue_id');
    }
}
