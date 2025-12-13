<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cartitem extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false; // Tắt timestamps nếu bảng không có create_at/update_at

    protected $fillable = [
        'cart_id',
        'product_id', // Bạn cần thêm trường này
        'name_product',
        'quantity',
        'price',
    ];

    // Mối quan hệ: CartItem thuộc về Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'id', 'cart_id');
    }

    // Mối quan hệ: CartItem liên kết với Product
    public function product()
    {
            return $this->belongsTo(Product::class, 'product_id', 'cart_id')->withDefault([
            'name' => 'Sản phẩm đã bị xóa',
            'price'=> '0'
        ]);
    }
}