<?php

use App\Http\Controllers\CostumeController;
use App\Imports\AccImport;
use App\Imports\CostumesImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/costumes', [CostumeController::class, 'index']);

Route::get('/import', function () {
    Excel::import(new CostumesImport, 'cost.xlsx');

    return response()->json(["Success"]);
});

Route::get('/import-acc', function () {
    Excel::import(new AccImport, 'acc.xlsx');

    return response()->json(["Success"]);
});
