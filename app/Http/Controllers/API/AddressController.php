<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    public function getProvinces(Request $request)
    {
        $provinces = Http::withHeaders([
            'key' => '05fb707215b778a76401b6996bc53823'
        ])->get('https://api.rajaongkir.com/starter/province')->json();

        return ResponseFormatter::success($provinces['rajaongkir']['results'], 'success');
    }

    public function getCities(Request $request)
    {
        $cities = Http::withHeaders([
            'key' => '05fb707215b778a76401b6996bc53823'
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => $request->province
        ])->json();

        // foreach ($cities['rajaongkir']['results'] as $city) {
        //     $city["city_name"] = $city["type"] . ' ' . $city["city_name"];
        // }

        $i = 0;
        while ($i < count($cities['rajaongkir']['results'])) {
            $cities['rajaongkir']['results'][$i]["city_name"] = $cities['rajaongkir']['results'][$i]["type"] . ' ' . $cities['rajaongkir']['results'][$i]["city_name"];
            $i++;
        }

        return ResponseFormatter::success($cities['rajaongkir']['results'], 'success');
    }

    public function getCost(Request $request)
    {
        $cost =
            Http::withHeaders([
                'key' => '05fb707215b778a76401b6996bc53823'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => 154,
                'destination' => $request->destination,
                'weight' => $request->weight,
                'courier' => 'jne'
            ])->json();

        return ResponseFormatter::success($cost['rajaongkir']['results'][0]['costs'][0]['cost'], 'success');
    }
}
