<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query();

        if ($request->start != null && $request->finish != null) {
            $start = $request->start;
            $finish = $request->finish;
            $orders = Order::whereBetween('rent_date', [$start, $finish])->get();
        } else {
            $orders = Order::all();
        }
        return view('orders', [
            'orders' => $orders,
            'title' => "Daftar Rental"
        ]);
    }
    public function detail($code)
    {
        return view('order', [
            'order' => Order::where('code', $code)->first(),
            'title' => "Detail Rental"
        ]);
    }


    public function alreadyShip()
    {
        return view('ordersAlreadyShip', [
            'orders' => Order::where('shipping_status', '!=', 'Diproses')->get(),
            'title' => "Daftar rental sudah dikirim"
        ]);
    }

    public function notShipYet()
    {
        return view('ordersNotShipYet', [
            'orders' => Order::where('shipping_status', 'Diproses')->get(),
            'title' => "Daftar rental belum dikirim"
        ]);
    }

    public function alreadyPaid()
    {
        return view('alreadyPaid', [
            'orders' => Order::where('payment_status', 'lunas')->get(),
            'title' => "Daftar rental sudah lunas"
        ]);
    }

    public function unpaid()
    {
        return view('unpaid', [
            'orders' => Order::where('payment_status', 'belum lunas')->get(),
            'title' => "Daftar rental belum lunas"
        ]);
    }

    public function alreadyReturned()
    {
        return view('alreadyReturned', [
            'orders' => Order::where('return_receipt', '!=', null)->get(),
            'title' => "Daftar rental sudah dikirim kembali"
        ]);
    }

    public function notReturnedYet()
    {
        return view('notReturnedYet', [
            'orders' => Order::where('return_status', 'Belum dikembalikan')->get(),
            'title' => "Daftar rental belum dikembalikan"
        ]);
    }

    public function lateReturned()
    {
        return view('lateReturned', [
            'orders' => Order::where('return_status', 'terlambat')->get(),
            'title' => "Daftar rental terlambat kembali"
        ]);
    }

    public function kirim(Request $request)
    {
        $code = $request->code;
        $order = Order::where('code', $code)->first();
        $order->shipping_status = $request->shipping_status;

        $order->save();

        return redirect()->back()->with('success', 'Berhasil mengubah status');
    }

    public function sudahBayar(Request $request)
    {
        $code = $request->code;
        $order = Order::where('code', $code)->first();
        $order->payment_status = 'lunas';

        $order->save();

        return redirect()->back()->with('success', 'Berhasil mengubah status');
    }
}
