@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Rental Belum Dikirim</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Rental Belum Dikirim
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
                            <th>Status Pengiriman</th>
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
                                <td>{{ $order->shipping_status }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal"
                                        onclick="sendData('{{ $order->code }}')">Sudah
                                        dikirim</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kostum</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Form" action="/kirim" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label">Kode Order</label>
                            <input type="text" class="form-control" id="code" name="code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="shipping_status" class="form-label">Resi</label>
                            <input type="text" class="form-control" id="shipping_status" name="shipping_status">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" onclick="submitForm()" class="btn btn-success">Tambah</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function sendData(code) {
            const input = document.getElementById("code")
            input.value = code

        }

        function submitForm() {
            const form = document.getElementById("Form")
            form.submit()
        }
    </script>
@endsection
