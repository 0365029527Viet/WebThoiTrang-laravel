<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paymentDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'price',
        'number',
        'size',
        'payment_id'
    ];
    public function payment() {
        return $this->belongsTo(Payment::class);
    }
    public function product(){
        return $this->belongsToMany(Product::class, 'payment_detail_product');
    }
}
