<?php

namespace App\Models;

use App\Models\Costume;
use App\Models\OrderAccessories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $guards = [];

    protected $fillable = [
        'name',
        'email',
        'telp_numb',
        'whatsapp',
        'instagram',
        'address',
        'family_number1',
        'family_number2',
        'post_code',
        'KTP_pict',
        'KTP_selfie',
        'payment_pict',
        'costume_id',
        'rent_date',
        'ship_date',
        'payment_status',
        'total_price',
        'DP',
        'shiping',
        'code',
        'resi',
        'return_receipt',
        'return_status'
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
