@extends('layouts.main')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Detail Kostum</h1>
        <div class="card mb-4">
            <div class="card-header">

                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-success btn-sm ms-auto">Edit</button>
            </div>
            <div class="card-body">
                <div class="col-12 mb-3 ">
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            Nama
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            {{ $costume->name }}
                        </div>
                    </div>
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            Kategori
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            {{ $costume->category->name }}
                        </div>
                    </div>
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            Sizes
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            {{ $costume->sizes }}
                        </div>
                    </div>
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            LD, LP
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            {{ $costume->ld }}, {{ $costume->lp }}
                        </div>
                    </div>
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            Harga
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            {{ $costume->price }}
                        </div>
                    </div>
                    <div class="row mb-1 gap-1 justify-content-center">
                        <div class="fw-bold col-4 bg-warning py-2 rounded">
                            Aksesoris
                        </div>
                        <div class="col-7 bg-warning py-2 rounded">
                            @if ($costume->accessories->count() > 0)
                                <ul>
                                    @foreach ($costume->accessories as $accessory)
                                        <li>{{ $accessory->name }}</li>
                                    @endforeach
                                </ul>
                            @else
                                Costume Tidak Punya Akseoris
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="Form" action="/costumes/{{ $costume->id }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Character</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $costume->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Kategori</label>
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Default select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $costume->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="sizes" class="form-label">Sizes</label>
                            <input type="text" class="form-control" id="sizes" name="sizes"
                                value="{{ $costume->sizes }}">
                        </div>
                        <div class="mb-3">
                            <label for="ld" class="form-label">LD</label>
                            <input type="text" class="form-control" id="ld" name="ld"
                                value="{{ $costume->ld }}">
                        </div>
                        <div class="mb-3">
                            <label for="lp" class="form-label">LP</label>
                            <input type="text" class="form-control" id="lp" name="lp"
                                value="{{ $costume->lp }}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ $costume->price }}">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Simpan</button>
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
