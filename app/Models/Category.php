<?php

namespace App\Models;

use App\Models\Costume;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guards = [];

    protected $fillable = [
        'name'
    ];

    public function costumes()
    {
        return $this->hasMany(Costume::class);
    }
}
