@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Kostum</h1>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Kostum
            </div>
            <div class="card-body table-responsive">
                <button class="btn btn-success btn-sm btn-add">Tambah Kostum</button>
                <table id="dataTable" class="table">
                    <thead>
                        <tr>
                            <th>Nama Character</th>
                            <th>Harga</th>
                            <th>Size</th>
                            <th>LD</th>
                            <th>LP</th>
                            <th>Kategori</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($costumes as $costume)
                            <tr>
                                <td>{{ $costume->name }}</td>
                                <td>Rp {{ number_format($costume->price, 0, ',', '.') }}</td>
                                <td>{{ $costume->sizes }}</td>
                                <td>{{ $costume->ld }}</td>
                                <td>{{ $costume->lp }}</td>
                                <td>{{ $costume->category->name }}</td>
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
