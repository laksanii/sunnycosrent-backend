<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Costume;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCostumeRequest;

class CostumeController extends Controller
{


    public function index()
    {
        return view('costumes', [
            'costumes' => Costume::all(),
            'categories' => Category::all(),
            'title' => "Daftar kostum"
        ]);
    }

    public function available(Request $request)
    {
        $start = date("Y-m-d");
        $finish = date("Y-m-d");
        if ($request->start != null) {
            $start = $request->start;
        }
        if ($request->finish != null) {
            $finish = $request->finish;
        }
        $costumes = DB::table('costumes')->join('categories', 'category_id', '=', 'categories.id')->select('costumes.*', 'categories.name as category')->whereNotIn('costumes.id', DB::table('orders')->select('costume_id')->whereBetween('rent_date', [DATE_ADD(date_create($start), date_interval_create_from_date_string("-4 days")), DATE_ADD(date_create($finish), date_interval_create_from_date_string("4 days"))]))->get();
        // $costumes =
        //     DB::table('costumes')->whereRaw("id NOT IN (SELECT costume_id from orders WHERE rent_date BETWEEN DATE_ADD ('$start',INTERVAL - 4 DAY) and DATE_ADD('$finish' , INTERVAL 4 DAY))")->get();
        return view('costumesAvail', [
            'costumes' => $costumes,
            'title' => "Daftar kostum available"
        ]);
    }

    public function booked(Request $request)
    {
        $start = date("Y-m-d");
        $finish = date("Y-m-d");
        if ($request->start != null) {
            $start = $request->start;
        }
        if ($request->finish != null) {
            $finish = $request->finish;
        }
        $costumes = DB::table('costumes')->join('categories', 'category_id', '=', 'categories.id')->select('costumes.*', 'categories.name as category')->whereIn('costumes.id', DB::table('orders')->select('costume_id')->whereBetween('rent_date', [DATE_ADD(date_create($start), date_interval_create_from_date_string("-4 days")), DATE_ADD(date_create($finish), date_interval_create_from_date_string("4 days"))]))->get();
        // $costumes =
        //     DB::table('costumes')->whereRaw("id NOT IN (SELECT costume_id from orders WHERE rent_date BETWEEN DATE_ADD ('$start',INTERVAL - 4 DAY) and DATE_ADD('$finish' , INTERVAL 4 DAY))")->get();
        return view('costumesBook', [
            'costumes' => $costumes,
            'title' => "Daftar kostum booked"
        ]);
    }

    public function store(StoreCostumeRequest $request)
    {
        //code...
        $costume = Costume::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'sizes' => $request->sizes,
            'ld' => $request->ld,
            'lp' => $request->lp,
            'price' => $request->price,
        ]);

        return redirect()->back()->with('success', 'Kostum berhasil ditambah');
    }
}
