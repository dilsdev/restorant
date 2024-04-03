<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPesanan extends Model
{
    use HasFactory;
    protected $table = 'item_pesanans';
    protected $primaryKey = 'id_itempesanan';
    protected $fillable = [ 'id_pesanan', 'id_produk', 'jumlah', 'subtotal'];
}
