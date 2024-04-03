<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjangs';
    protected $primaryKey = 'id_keranjang';
    protected $fillable =['id_pelanggan','id_produk', 'tanggal', 'qty'];  
}
