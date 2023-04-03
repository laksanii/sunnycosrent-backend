@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Accessories</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('success_delete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success_delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Accessories
            </div>
            <div class="card-body table-responsive">
                <button class="btn btn-success btn-sm btn-add" data-bs-toggle="modal" data-bs-target="#costumeForm">Tambah
                    Aksesori</button>
                <!-- Button trigger modal -->
                <table id="dataTable" class="table">
                    <thead>
                        <tr>
                            <th>Nama Aksesori</th>
                            <th>Harga</th>
                            <th>Kostum</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($accessories as $accessory)
                            <tr>
                                <td>{{ $accessory->name }}</td>
                                <td>{{ $accessory->price }}</td>
                                <td>{{ $accessory->costume->name }}</td>
                                <td>
                                    <form action="/accessories/delete" method="post">
                                        @csrf
                                        <input type="text" hidden value="{{ $accessory->id }}" name="id">
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="costumeForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kostum</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Form" action="/accessories" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Aksesori</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="costume_id" class="form-label">Character</label>
                            <select class="form-select js-example-basic-single" name="costume_id" id="costume_id"
                                aria-label="Default select example">
                                @foreach ($costumes as $costume)
                                    <option value="{{ $costume->id }}">{{ $costume->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="price" name="price">
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
        function submitForm() {
            const form = document.getElementById("Form");
            form.submit()

        }
    </script>
@endsection
