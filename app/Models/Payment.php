<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'phone',
        'address',
        'user_id',
        'time'
    ];
    public function user()  
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
    public function paymentDetail() 
    {
        return $this->hasOne(paymentDetail::class, 'payment_id', 'id');   
    }
}
