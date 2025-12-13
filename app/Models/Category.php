<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'cate_id';

    protected $fillable = [
        'name',
        'description',
    ];

    // Mối quan hệ: Một Category có nhiều Product
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'cate_id');
    }
}