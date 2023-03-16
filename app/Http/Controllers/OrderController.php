<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('orders', [
            'orders' => Order::all()
        ]);
    }

    public function alreadyShip()
    {
        return view('ordersAlreadyShip', [
            'orders' => Order::where('shipping_status', '!=', 'Diproses')->get(),
        ]);
    }

    public function notShipYet()
    {
        return view('ordersNotShipYet', [
            'orders' => Order::where('shipping_status', 'Diproses')->get(),
        ]);
    }

    public function alreadyPaid()
    {
        return view('alreadyPaid', [
            'orders' => Order::where('payment_status', 'lunas')->get(),
        ]);
    }

    public function unpaid()
    {
        return view('unpaid', [
            'orders' => Order::where('payment_status', 'belum lunas')->get(),
        ]);
    }

    public function alreadyReturned()
    {
        return view('alreadyReturned', [
            'orders' => Order::where('return_receipt', '!=', null)->get()
        ]);
    }

    public function notReturnedYet()
    {
        return view('notReturnedYet', [
            'orders' => Order::where('return_status', 'Belum dikembalikan')->get()
        ]);
    }

    public function lateReturned()
    {
        return view('lateReturned', [
            'orders' => Order::where('return_status', 'terlambat')->get()
        ]);
    }
}
