<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'size',
        'sale',
        'number',
        'status',
        'cate_id',
        'sale_id',
    ];
    public function category() {
        return $this->hasOne(Category::class, 'id', 'cate_id');
    }
    public function sale() {
        return $this->hasOne(Sale::class, 'id', 'sale_id');
    }
    public function paymentDetail() {
        return $this->belongsToMany(paymentDetail::class);
    }
}
