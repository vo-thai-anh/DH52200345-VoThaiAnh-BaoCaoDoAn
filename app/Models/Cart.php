<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts'; // Khai báo tên bảng
    protected $primaryKey = 'cart_id';
    public $timestamps = false; // Tắt timestamps nếu bảng không có create_at/update_at

    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at'
        // 'create_at', // Nếu bạn định nghĩa create_at trong Migration
    ];

    // Mối quan hệ: Một Cart thuộc về một User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'cart_id');
    }

    // Mối quan hệ: Một Cart có nhiều CartItem
    public function items()
    {
        return $this->hasMany(Cartitem::class, 'id', 'cart_id');
    }
}