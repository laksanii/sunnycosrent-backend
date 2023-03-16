<?php

namespace App\Models;

use App\Models\Costume;
use App\Models\OrderAccessories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guards = [];

    protected $fillable = [
        'name',
        'price',
        'status',
        'costume_id'
    ];
    public function costume()
    {
        return $this->belongsTo(Costume::class);
    }

    public function order_accessories()
    {
        return $this->hasMany(OrderAccessories::class);
    }
}
