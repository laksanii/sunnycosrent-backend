<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmPict extends Model
{
    use HasFactory;

    protected $guards = [];

    protected $fillable = [
        "order_id",
        "path"
    ];


    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
