@extends('layout.template')
@section('template')
    <div class="row col-12 m-2">
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn col-2 btn-primary btn-lg"
            data-bs-toggle="modal"
            data-bs-target="#modalId"
        >
            Tambah Produk
        </button>

        <!-- Modal -->
        <div
            class="modal fade"
            id="modalId"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modalTitleId"
            aria-hidden="true"
        >
            <div
                class="modal-dialog modal-xl modal-fullscreen-xl-down"
                role="document">
            <form action="simpanproduk" method="post" enctype="multipart/form-data" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah produk
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama produk</label>
                            <input
                            required
                                type="text"
                                name="nama_produk"
                                id="nama_produk"
                                class="form-control"
                                placeholder="Nama produk"
                                aria-describedby="helpId1"
                            />
                            <small id="helpId1" class="text-muted">masukkan nama produk kamu</small>
                        </div>
                        <div class="mb-3">
                            <label for="gambar" class="form-label">Gambar</label>
                            <input
                            required
                                type="file"
                                class="form-control"
                                name="gambar"
                                id="gambar"
                                aria-describedby="helpId2"
                                placeholder="Gambar"
                            />
                            <small id="helpId2" class="form-text text-muted">Masukkan gambar produknya</small>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input
                            required
                                type="number"
                                class="form-control"
                                name="harga"
                                id="harga"
                                aria-describedby="helpId3"
                                placeholder="Harga"
                            />
                            <small id="helpId3" class="form-text text-muted">Harga produk</small>
                        </div>
                        <div class="mb-3">
                            <label for="sisa" class="form-label">Sisa</label>
                            <input
                            required
                                type="text"
                                class="form-control"
                                name="sisa"
                                id="sisa"
                                aria-describedby="helpId4"
                                placeholder="Sisa"
                            />
                            <small id="helpId4" class="form-text text-muted">Sisa makanan</small>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <input
                            required
                                type="text"
                                class="form-control"
                                name="deskripsi"
                                id="deskripsi"
                                aria-describedby="helpId5"
                                placeholder=""
                            />
                            <small id="helpId5" class="form-text text-muted">Deskripsikan makanan itu seperti apa</small>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>

    </div>
    <div class="row">
        <div
            class="table-responsive"
        >
            <table
                class="table table-striped table-hover"
            >
                <thead>
                    <tr>
                        <th>No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Sisa</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $item)
                    <tr class="">
                        <td>{{ $no }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        {{-- <td>{{ $item->gambar }}</td> --}}
                        <td><img
                            src="{{ asset('foto/'.$item->gambar) }}"
                            class="img-fluid rounded-top"
                            style="height: 150px"
                            alt=""
                        />
                        </td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->sisa }}</td>
                        <td>{{ $item->deskripsi }}</td>
                        <td><button
                            type="button"
                            class="btn btn-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#modalId{{ $no }}"
                        >
                            Edit
                        </button>

                        <!-- Modal -->
                        <div
                            class="modal fade"
                            id="modalId{{ $no++ }}"
                            tabindex="-1"
                            role="dialog"
                            aria-labelledby="modalTitleId"
                            aria-hidden="true"
                        >
                            <div
                                class="modal-dialog modal-xl modal-fullscreen-xl-down"
                                role="document">
                                <form action="{{ route('editproduk',  $item->id_produk) }}" method="POST" enctype="multipart/form-data" class="modal-content">
                                    @csrf
                                    @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Edit {{ $item->nama_produk }}
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">

                                        <div class="mb-3">
                                            <label for="nama_produk" class="form-label">Nama produk</label>
                                            <input
                                            required
                                                type="text"
                                                name="nama_produk"
                                                value="{{ $item->nama_produk }}"
                                                id="nama_produk"
                                                class="form-control"
                                                placeholder="Nama produk"
                                                aria-describedby="helpId1"
                                            />
                                            <small id="helpId1" class="text-muted">masukkan nama produk kamu</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="gambar" class="form-label">Gambar</label>
                                            <input
                                            required
                                                type="file"
                                                class="form-control"
                                                value="{{ $item->gambar }}"
                                                name="gambar"
                                                id="gambar"
                                                aria-describedby="helpId2"
                                                placeholder="Gambar"
                                            />
                                            <small id="helpId2" class="form-text text-muted">Masukkan gambar produknya</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="harga" class="form-label">Harga</label>
                                            <input
                                            required
                                                type="number"
                                                class="form-control"
                                                name="harga"
                                                value="{{ $item->harga }}"
                                                id="harga"
                                                aria-describedby="helpId3"
                                                placeholder="Harga"
                                            />
                                            <small id="helpId3" class="form-text text-muted">Harga produk</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="sisa" class="form-label">Sisa</label>
                                            <input
                                            required
                                                type="text"
                                                class="form-control"
                                                name="sisa"
                                                value="{{ $item->sisa }}"
                                                id="sisa"
                                                aria-describedby="helpId4"
                                                placeholder="Sisa"
                                            />
                                            <small id="helpId4" class="form-text text-muted">Sisa makanan</small>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <input
                                            required
                                                type="text"
                                                class="form-control"
                                                name="deskripsi"
                                                value="{{ $item->deskripsi }}"
                                                id="deskripsi"
                                                aria-describedby="helpId5"
                                                placeholder=""
                                            />
                                            <small id="helpId5" class="form-text text-muted">Deskripsikan makanan itu seperti apa</small>
                                        </div>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button
                                        type="button"
                                        class="btn btn-secondary"
                                        data-bs-dismiss="modal"
                                    >
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                            </div>
                        </div></td>
                        <td><form action="hapusproduk" method="POST">
                            @csrf
                            @method('DELETE')
                            <input
                            required type="hidden" name="id" value="{{ $item->id_produk }}">
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>

    </div>
@endsection
