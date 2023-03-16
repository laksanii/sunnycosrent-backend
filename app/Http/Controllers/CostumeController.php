<?php

namespace App\Http\Controllers;

use App\Models\Costume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CostumeController extends Controller
{


    public function index()
    {
        return view('costumes', [
            'costumes' => Costume::all()
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
            'costumes' => $costumes
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
            'costumes' => $costumes
        ]);
    }
}
