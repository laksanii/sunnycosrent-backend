<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\CostumePict;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCostumePictRequest;

class CostumePictController extends Controller
{
    public function store(StoreCostumePictRequest $request)
    {
        try {
            //code...
            $files = $request->file('path');

            foreach ($files as $file) {
                $path = $file->store('public/costumePict');
                $costume = CostumePict::create([
                    'path' => $path,
                    'costume_id' => $request->input('costume_id')
                ]);

                if (!$costume) {
                    throw new Exception('Costume pict stored failed');
                }
            }


            return ResponseFormatter::success(null, 'Costume pict stored successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}