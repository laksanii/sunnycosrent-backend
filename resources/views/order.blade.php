@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Rental</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Code: {{ $order->code }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-8 mb-3 ">
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Nama
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->name }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                email
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->email }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                whatsapp
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->whatsapp }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                instagram
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->instagram }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Alamat Lengkap
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->address }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Kode Pos
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->post_code }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Kostum (Nama Character)
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->costume->name }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Tanggal Rental
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->rent_date }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Tanggal Pengiriman
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->ship_date }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Pembayaran
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->payment }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Status Pembayaran
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                {{ $order->payment_status }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                DP
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                Rp {{ number_format($order->DP, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Total Harga
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="row mb-1 gap-1 justify-content-center">
                            <div class="fw-bold col-4 bg-warning py-2 rounded">
                                Aksesoris
                            </div>
                            <div class="col-7 bg-warning py-2 rounded">
                                @if ($order->order_accessories->count() < 1)
                                    Tidak pakai aksesoris
                                @else
                                    <ul>
                                        @foreach ($order->order_accessories as $accessory)
                                            <li>{{ $accessory->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 ">
                        <div class="d-flex flex-column align-items-center fw-bold">
                            Bukti Transfer
                            <div class="pict-wraper border border-2 mb-2">
                                <img src="{{ Storage::url($order->payment_pict) }}" class="pict payment-pict"
                                    alt="Foto">
                            </div>
                            Foto KTP/KK/Kartu Pelajar
                            <div class="pict-wraper border border-2 mb-2">
                                <img src="{{ Storage::url($order->KTP_pict) }}" class="pict payment-pict" alt="Foto">
                            </div>
                            Foto Selfie
                            <div class="pict-wraper border border-2 mb-2">
                                <img src="{{ Storage::url($order->KTP_selfie) }}" class="pict payment-pict" alt="Foto">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4 picts-box">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bukti Konfirmasi Diterima
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($order->confirm_pict as $pict)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <img src="{{ Storage::url($pict->path) }}" alt="confirm_pict" style="width: 100%">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card mb-4 picts-box">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Bukti Pengembalian
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($order->return_pict as $pict)
                        <div class="col-lg-3 col-md-6 mb-3">
                            <img src="{{ Storage::url($pict->path) }}" alt="confirm_pict" style="width: 100%">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
