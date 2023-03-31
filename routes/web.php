<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\CostumeController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function () {
    Route::get('/', [CostumeController::class, 'index']);
    Route::get('/home', [CostumeController::class, 'index']);

    Route::get('/costumes', [CostumeController::class, 'index']);
    Route::get('/costumes/{id}', [CostumeController::class, 'detail']);
    Route::post('/costumes/{id}', [CostumeController::class, 'edit']);
    Route::get('/costumes-available', [CostumeController::class, 'available']);
    Route::get('/costumes-booked', [CostumeController::class, 'booked']);

    Route::get('/rental', [OrderController::class, 'index']);
    Route::get('/rental/{code}', [OrderController::class, 'detail']);
    Route::get('/rental-sudah-dikirim', [OrderController::class, 'alreadyShip']);
    Route::get('/rental-belum-dikirim', [OrderController::class, 'notShipYet']);
    Route::get('/rental-sudah-lunas', [OrderController::class, 'alreadyPaid']);
    Route::get('/rental-belum-lunas', [OrderController::class, 'unpaid']);
    Route::get('/pengembalian-sudah-dikirim', [OrderController::class, 'alreadyReturned']);
    Route::get('/pengembalian-belum-dikirim', [OrderController::class, 'notReturnedYet']);
    Route::get('/pengembalian-terlambat', [OrderController::class, 'lateReturned']);
    Route::post('/kirim', [OrderController::class, 'kirim']);
    Route::post('/sudah-bayar', [OrderController::class, 'sudahBayar']);

    Route::post('/tambah-costume', [CostumeController::class, 'store']);

    Route::post('/logout', [UserController::class, 'logout']);
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/register', function () {
        return view('register');
    });
    Route::post('/register', [UserController::class, 'register']);
});

Route::get('/import', function () {
    Excel::import(new CostumesImport, 'cost.xlsx');

    return response()->json(["Success"]);
});

Route::get('/import-acc', function () {
    Excel::import(new AccImport, 'acc.xlsx');

    return response()->json(["Success"]);
});

Route::get('/storage/{folder_pict}/{code}/{file}',);
