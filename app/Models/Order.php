<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItems;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'email',
        'address',
        'country',
        'city',
        'state',
        'code',
        'total_price',
        'status',
        'message',
        'tracking_no'
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
}
