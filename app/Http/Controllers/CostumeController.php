<?php

namespace App\Http\Controllers;

use App\Models\Costume;
use Illuminate\Http\Request;

class CostumeController extends Controller
{


    public function index()
    {
        return view('costumes', [
            'costumes' => Costume::all()
        ]);
    }
}
