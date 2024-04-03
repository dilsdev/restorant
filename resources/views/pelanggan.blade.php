@extends('layout.template')
@section('template')
<!-- Modal trigger button -->
<button
    type="button"
    class="btn btn-primary mb-2 btn-lg"
    data-bs-toggle="modal"
    data-bs-target="#modalId"
>
    Tambah pelanggan
</button>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"

    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true"
>
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl"
        role="document"
    >
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Tambah pelanggan
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <form method="POST" action="tambahpelanggan" class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input
                        required
                        type="text"
                        name="nama"
                        id="nama"
                        class="form-control form-control-lg"
                        placeholder="Nama"
                        aria-describedby="helpId1"
                    />
                    <small id="helpId1" class="text-muted">Masukkan nama</small>
                </div>
                <div class="mb-3">
                    <label for="telepon" class="form-label">Telepon</label>
                    <input
                        required
                        type="number"
                        name="telepon"
                        id="telepon"
                        class="form-control form-control-lg"
                        placeholder="085xxxxxxxx"
                        aria-describedby="helpId2"
                    />
                    <small id="helpId2" class="text-muted">Masukkan nomor telepon</small>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input
                        required
                        type="email"
                        name="email"
                        id="email"
                        class="form-control form-control-lg"
                        placeholder="contoh@gmail.com"
                        aria-describedby="helpId3"
                    />
                    <small id="helpId3" class="text-muted">Masukkan email</small>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script>
<form method="GET" action="/pelanggan" class="col-4" style="float: right; margin-left: auto">
    <input
        type="search"
        class="form-control"
        name="search"
        id="inputPassword6"
        aria-describedby="helpId"
        placeholder="Search"
    />
</form>
<div
    class="table-responsive"
>
    <table
        class="table table-striped table-hover"
    >
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama</th>
                <th scope="col">Telepon</th>
                <th scope="col">Email</th>
            </tr>
        </thead>
        <tbody>
            @php
                $key=1;
            @endphp
            @foreach ($data as $item)
            <tr class="">
                <td>{{ $key++ }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->telepon }}</td>
                <td>{{ $item->email }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>

@endsection
