<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessoryRequest;
use App\Http\Requests\UpdateAccessoryRequest;

class AccessoryController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $costume_id = $request->input('costume_id');
        $limit = $request->input('limit', 10);

        $accessoryQuery = Accessory::with(['costume']);

        $accessory = $accessoryQuery;

        if ($costume_id) {
            $accessory = $accessoryQuery->where('costume_id', $costume_id);
        }

        if ($id) {
            $accessory = $accessoryQuery->find($id);
            if ($accessory) {
                return ResponseFormatter::success($accessory, 'Accessory found');
            }
            return ResponseFormatter::success(
                null,
                'Accessory not found'
            );
        }

        if ($accessory->count()) {
            return ResponseFormatter::success(
                $accessory->paginate($limit),
                'Accessory found'
            );
        }

        return ResponseFormatter::success(
            null,
            'Accessory not found'
        );
    }

    // STORE
    public function store(StoreAccessoryRequest $request)
    {
        try {
            //code...
            $accessory = Accessory::create([
                'name' => $request->name,
                'price' => $request->price,
                'costume_id' => $request->costume_id,
            ]);

            if (!$accessory) {
                throw new Exception('accessory stored failed');
            }

            return ResponseFormatter::success($accessory, 'accessory stored successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(UpdateAccessoryRequest $request, $id)
    {
        try {
            //code...
            $accessory = accessory::find($id);

            if (!$accessory) {
                throw new Exception('accessory not found');
            }

            // Update accessory
            $accessory->update([
                'name' => $request->name,
                'price' => $request->price,
                'costume_id' => $request->costume_id,
            ]);

            return ResponseFormatter::success($accessory, 'accessory updated successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // DELETE
    public function delete($id)
    {
        try {
            //code...
            $accessory = accessory::find($id);

            if (!$accessory) {
                throw new Exception('accessory not found');
            }

            $accessory->delete();

            return ResponseFormatter::success('accessory deleted successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}