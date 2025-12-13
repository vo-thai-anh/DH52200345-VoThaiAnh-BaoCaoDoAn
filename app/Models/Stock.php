<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
        protected $table = 'stocks';
        protected $primaryKey = 'id';
    protected $fillable = [
        'product_id',
        'quantity',
        'min_stock',
        'updated_by'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

