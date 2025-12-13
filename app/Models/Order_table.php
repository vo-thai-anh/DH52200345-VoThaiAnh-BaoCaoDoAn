<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_table extends Model
{
    protected $table = 'order_tables';
    protected $primaryKey = 'order_id';
    public $timestamps = true;

    protected $fillable = [
        'user_id', 'total_amount', 'status', 'created_at','updated_at', 'shipping_fee',
        'final_total', 'fullname', 'phone', 'address', 'note', 'method_pay'
    ];
    
    // Mối quan hệ: Order thuộc về User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    // Mối quan hệ: Order có nhiều OrderDetail
    public function details()
    {
        return $this->hasMany(Orderdt::class, 'order_id', 'order_id');
    }
}