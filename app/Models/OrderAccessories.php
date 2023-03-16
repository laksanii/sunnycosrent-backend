<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Accessory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderAccessories extends Model
{
    use HasFactory;

    protected $guards = [];


    protected $fillable = [
        'order_id',
        'accessory_id',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class);
    }
}
