<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Costume;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCostumeRequest;
use App\Http\Requests\UpdateCostumeRequest;
use GuzzleHttp\Psr7\Response;

class CostumeController extends Controller
{
    // FETCH
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $category = $request->input('category');
        $limit = $request->input('limit', 10);
        $all = $request->input('all');

        $costumeQuery = Costume::with(['accessories', 'category']);

        if ($all == 'true') {
            $costume = $costumeQuery->get();
            return ResponseFormatter::success($costume, 'Costume found');
        }

        if ($category) {
            $costumeQuery = Costume::whereHas('category', function ($query) use ($category) {
                $query->where('name', 'like', '%' . $category . '%');
            });
        }

        // Get single data
        if ($id) {
            $costume = $costumeQuery->find($id);

            if ($costume) {
                return ResponseFormatter::success($costume, 'Costume found');
            }

            return ResponseFormatter::error('Costume not found', 404);
        }

        // Get multiple data
        $costume = $costumeQuery;

        if ($name) {
            if ($costume->where('name', 'like', '%' . $name . '%')->count()) {
                return ResponseFormatter::success(
                    $costume->paginate($limit),
                    'Costume found'
                );
            }

            return ResponseFormatter::error('Costume not found', 404);
        }

        return ResponseFormatter::success(
            $costume->paginate($limit),
            'Order found'
        );
    }

    // STORE
    public function store(StoreCostumeRequest $request)
    {
        try {
            //code...
            $costume = Costume::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'sizes' => $request->sizes,
                'ld' => $request->ld,
                'lp' => $request->lp,
                'price' => $request->price,
            ]);

            if (!$costume) {
                throw new Exception('Costume stored failed');
            }

            return ResponseFormatter::success($costume, 'Costume stored successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(UpdateCostumeRequest $request, $id)
    {
        try {
            //code...
            $costume = Costume::find($id);

            if (!$costume) {
                throw new Exception('Costume not found');
            }

            // Update costume
            $costume->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'sizes' => $request->sizes,
                'ld' => $request->ld,
                'lp' => $request->lp,
                'price' => $request->price,
            ]);

            return ResponseFormatter::success($costume, 'Costume updated successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // DELETE
    public function delete($id)
    {
        try {
            //code...
            $costume = Costume::find($id);

            if (!$costume) {
                throw new Exception('Costume not found');
            }

            $costume->delete();

            return ResponseFormatter::success('Costume deleted successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}
