<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orderdt extends Model
{
    protected $primaryKey = 'orderdt_id';
    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'name',
        'quantity',
        'price',
    ];

    // Mối quan hệ: OrderDT thuộc về Order
    public function order()
    {
        return $this->belongsTo(Order_table::class, 'order_id', 'order_id');
    }

    // Mối quan hệ: OrderDT liên kết với Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}