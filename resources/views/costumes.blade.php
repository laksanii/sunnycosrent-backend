@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Daftar Kostum</h1>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Kostum
            </div>
            <div class="card-body table-responsive">
                <button class="btn btn-success btn-sm btn-add" data-bs-toggle="modal" data-bs-target="#costumeForm">Tambah
                    Kostum</button>
                <!-- Button trigger modal -->
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
    <!-- Modal -->
    <div class="modal fade" id="costumeForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kostum</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Form" action="/tambah-costume" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Character</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sizes" class="form-label">Sizes</label>
                            <input type="text" class="form-control" id="sizes" name="sizes">
                        </div>
                        <div class="mb-3">
                            <label for="ld" class="form-label">LD</label>
                            <input type="text" class="form-control" id="ld" name="ld">
                        </div>
                        <div class="mb-3">
                            <label for="lp" class="form-label">LP</label>
                            <input type="text" class="form-control" id="lp" name="lp">
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
