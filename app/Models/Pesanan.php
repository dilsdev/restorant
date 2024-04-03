<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanans';
    protected $primaryKey = 'id_pesanan';
    protected $fillable = ['id_pelanggan', 'id_pelanggan', 'id_meja', 'id_karyawan', 'tanggal_pesanan', 'total_pesanan', 'total_harga'];
}
