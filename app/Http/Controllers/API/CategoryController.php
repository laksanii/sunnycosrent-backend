<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $limit = $request->input('limit', 10);

        $categoryQuery = Category::with(['costumes']);

        $category = $categoryQuery;

        if ($name) {
            $category = $categoryQuery->where('name', $name)->first();
            if ($category) {
                return ResponseFormatter::success($category, 'Category found');
            }
            return ResponseFormatter::success(
                null,
                'Category not found'
            );
        }

        if ($id) {
            $category = $categoryQuery->find($id);
            if ($category) {
                return ResponseFormatter::success($category, 'Category found');
            }
            return ResponseFormatter::success(
                null,
                'Category not found'
            );
        }

        return ResponseFormatter::success(
            $category->paginate($limit),
            'Category found'
        );
    }

    // STORE
    public function store(StoreCategoryRequest $request)
    {
        try {
            //code...
            $category = Category::create([
                'name' => $request->name,
            ]);

            if (!$category) {
                throw new Exception('category stored failed');
            }

            return ResponseFormatter::success($category, 'category stored successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // UPDATE
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            //code...
            $category = category::find($id);

            if (!$category) {
                throw new Exception('category not found');
            }

            // Update category
            $category->update([
                'name' => $request->name,
            ]);

            return ResponseFormatter::success($category, 'category updated successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // DELETE
    public function delete($id)
    {
        try {
            //code...
            $category = category::find($id);

            if (!$category) {
                throw new Exception('category not found');
            }

            $category->delete();

            return ResponseFormatter::success('category deleted successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }
}