<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['nama_pelanggan', 'total_harga', 'metode_pembayaran', 'status'];

public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}
}
