<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnPict extends Model
{
    use HasFactory;

    protected $guards = [];

    protected $fillable = [
        "order_id",
        "path"
    ];


    public function order()
    {
        return $this->hasOne(Order::class);
    }
}
