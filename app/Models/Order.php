<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem ;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
     'user_id',
     'total_price',
     'address',
     'payment_method',
     'money_received'
    ];

    public function user () {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
