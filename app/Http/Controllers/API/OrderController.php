<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\Order;
use App\Models\Costume;
use App\Models\Accessory;
use App\Models\ReturnPict;
use App\Models\ConfirmPict;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Models\OrderAccessories;
use PhpParser\Node\Stmt\TryCatch;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreCostumeRequest;
use App\Http\Requests\UpdateCostumeRequest;

class OrderController extends Controller
{
    public function fetch(Request $request)
    {
        $id = $request->input('id');
        $costume_id = $request->input('costume_id');
        $limit = $request->input('limit', 10);

        $orderQuery = Order::with(['costume', 'order_accessories']);

        // Get single data
        if ($id) {
            $order = $orderQuery->find($id);

            if ($order) {
                return ResponseFormatter::success($order, 'Order found');
            }

            return ResponseFormatter::success(null, 'Order not found');
        }

        // Get multiple data
        $order = $orderQuery;

        if ($costume_id) {
            if ($order->where('costume_id', $costume_id)->count()) {
                return ResponseFormatter::success(
                    $order->paginate($limit),
                    'Order found'
                );
            }

            return ResponseFormatter::success(null, 'Order not found');
        }

        return ResponseFormatter::success(
            $order->paginate($limit),
            'Order found'
        );
    }

    // FETCH BY CODE
    public function fetchByCode(Request $request, $code)
    {
        $order = Order::with(['costume', 'order_accessories', 'order_accessories.accessory'])->where('code', $code)->first();

        if ($order) {
            return ResponseFormatter::success($order, 'Order found');
        }

        return ResponseFormatter::error('Order not found');
    }

    // STORE
    public function store(StoreOrderRequest $request)
    {
        try {
            //code...
            $costume_id = $request->costume_id;
            $rent_date = new CarbonImmutable($request->rent_date);


            $orders = Order::where('costume_id', $costume_id)->whereBetween('rent_date', [$rent_date->subDays(4), $rent_date->addDays(4)])->get();

            if (!$orders->count() > 0) {
                $order = Order::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'telp_numb' => $request->telp_numb,
                    'whatsapp' => $request->whatsapp,
                    'instagram' => $request->instagram,
                    'address' => $request->address,
                    'family_number1' => $request->family_number1,
                    'family_number2' => $request->family_number2,
                    'post_code' => $request->post_code,
                    'costume_id' => $request->costume_id,
                    'rent_date' => $request->rent_date,
                    'ship_date' => $request->ship_date,
                    'total_price' => $request->total_payment,
                    'payment' => $request->payment,
                    'DP' => $request->DP,
                ]);

                if (!$order) {
                    throw new Exception('Book gagal');
                }

                $numb = rand(1, 999) . date('dmy');
                $code = 'ORD' . str_pad($order->id, 3, "0", STR_PAD_LEFT) . str_pad($numb, 9, "0", STR_PAD_LEFT);
                $ktp_pict_path = $request->file('KTP_pict')->store('public');
                $ktp_selfie_path = $request->file('KTP_selfie')->store('public');
                $payment_pict_path = $request->file('payment_pict')->store('public');

                $order->KTP_pict = $ktp_pict_path;
                $order->KTP_selfie = $ktp_selfie_path;
                $order->payment_pict = $payment_pict_path;
                $order->code = $code;
                $order->save();
                // dd($request->accessories);
                if ($request->accessories) {
                    foreach ($request->accessories as $accessory) {
                        $accessory_detail = Accessory::find($accessory);
                        $orderAccsessory = new OrderAccessories;
                        $orderAccsessory->order_id = $order->id;
                        $orderAccsessory->accessories_id = $accessory;
                        $orderAccsessory->price = $accessory_detail->price;
                        $orderAccsessory->save();
                    }
                }

                return ResponseFormatter::success($order, 'Book berhasil');
            } else {
                throw new Exception('Costume sudah dirental ditanggal tersebut');
            }
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 500);
        }
    }

    // KONFIRMASI
    public function konfirmasi(Request $request)
    {
        try {
            $code = $request->code;
            $order = Order::where('code', $code)->first();

            if (!$order) {
                throw new Exception('confirmation failed');
            }

            foreach ($request->file('confirm_pict') as $file) {
                $path = $file->store('public');
                ConfirmPict::create([
                    'order_id' => $order->id,
                    'path' => $path,
                ]);
            }

            $order->shipping_status = 'Sudah diterima';

            $order->save();

            return ResponseFormatter::success($order, 'Confirmation successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    //PENGEMBALIAN

    public function pengembalian(Request $request)
    {
        try {
            $code = $request->code;
            $order = Order::where('code', $code)->first();

            if (!$order) {
                throw new Exception('Return failed');
            }

            foreach ($request->file('return_pict') as $file) {
                $path = $file->store('public');
                ReturnPict::create([
                    'order_id' => $order->id,
                    'path' => $path,
                ]);
            }

            $order->return_receipt = $request->resi;
            $order->return_status = 'Sedang dikirim kembali';

            $order->save();

            return ResponseFormatter::success($order, 'Return successfully');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 400);
        }
    }

    // COSTUME AVAILABLE CHECK
    public function costumeCheck(Request $request)
    {

        $costume_id = $request->costume_id;
        $rent_date = new CarbonImmutable($request->rent_date);


        $orders = Order::where('costume_id', $costume_id)->whereBetween('rent_date', [$rent_date->subDays(4), $rent_date->addDays(4)])->get();

        if (!$orders->count() > 0) {
            return ResponseFormatter::success(true, "Kostum available buat dirental ditanggal $request->rent_date");
        }

        return ResponseFormatter::success(false, "Kostum tidak bisa dirental ditanggal " . $rent_date);
    }
}
