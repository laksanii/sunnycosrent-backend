<?php

namespace App\Models;

use App\Models\Costume;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CostumePict extends Model
{
    use HasFactory;

    protected $guards = [];

    protected $fillable = [
        'path',
        'costume_id'
    ];

    public function costume()
    {
        return $this->belongsTo(Costume::class);
    }
}
