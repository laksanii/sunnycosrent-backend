<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Category;
use App\Models\Accessory;
use App\Models\CostumePict;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Costume extends Model
{
    use HasFactory, SoftDeletes;

    protected $guards = [];

    protected $fillable = [
        "name",
        "category_id",
        "sizes",
        "ld",
        "lp",
        "price"
    ];

    public function accessories()
    {
        return $this->hasMany(Accessory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

    public function costume_picts()
    {
        return $this->hasMany(CostumePict::class);
    }
}
