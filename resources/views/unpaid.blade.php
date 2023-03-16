@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Rental Belum Lunas</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Rental Belum Lunas
            </div>
            <div class="card-body table-responsive">
                <table id="dataTable" class="table nowrap pe-2 ">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>Whatsapp</th>
                            <th>Instagram</th>
                            <th>Alamat</th>
                            <th>Kode Pos</th>
                            <th>Character</th>
                            <th>Status Pembayaran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->whatsapp }}</td>
                                <td>{{ $order->instagram }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->post_code }}</td>
                                <td>{{ $order->costume->name }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <div class="btn btn-success btn-sm">Edit</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
