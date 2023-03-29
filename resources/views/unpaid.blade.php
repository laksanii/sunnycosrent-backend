@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Rental Belum Lunas</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                            <th>Rent Date</th>
                            <th>Ship Date</th>
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
                                <td>{{ $order->rent_date }}</td>
                                <td>{{ $order->ship_date }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <form action="/sudah-bayar" method="post">
                                        @csrf
                                        <input type="text" name="code" id="code" value="{{ $order->code }}"
                                            hidden>
                                        <button type="submit" class="btn btn-success btn-sm">Sudah
                                            dibayar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
