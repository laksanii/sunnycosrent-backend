<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class Address
{
    public function getProvinces($id = null)
    {
        $provinces = Http::withHeaders([
            'key' => '05fb707215b778a76401b6996bc53823'
        ])->get('https://api.rajaongkir.com/starter/province')->json();

        return $provinces['rajaongkir']['results'];
    }
}
