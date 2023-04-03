<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Costume;
use App\Models\Accessory;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccessoryRequest;

class AccessoryController extends Controller
{
    public function index()
    {
        return view('accessories', [
            'accessories' => Accessory::all(),
            'costumes' => Costume::orderBy('name', 'asc')->get(),
            'title' => 'Daftar Accessories'
        ]);
    }

    public function store(StoreAccessoryRequest $request)
    {
        //code...
        $accessory = Accessory::create([
            'name' => $request->name,
            'price' => $request->price,
            'costume_id' => $request->costume_id,
        ]);

        if (!$accessory) {
            return redirect()->back()->with('error_msg', 'Tambah aksesori gagal');
        }
        return redirect()->back()->with('success', 'Tambah aksesori berhasil');
    }

    public function delete(Request $request)
    {
        $accessory = Accessory::find($request->id);

        $accessory->delete();

        return redirect()->back()->with('success_delete', 'Aksesori berhasil dihapus');
    }
}
