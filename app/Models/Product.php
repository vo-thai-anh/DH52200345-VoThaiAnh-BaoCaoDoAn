<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
        protected $table = 'products';
        protected $keyType = 'int';
        protected $primaryKey = 'product_id';
        public $incrementing = true;

    protected $fillable = [
        'category_id',
        'price',
        'name',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'cate_id');
    }
    public function stock(){
        return $this->hasOne(Stock::class, 'product_id', 'product_id');
    }
}