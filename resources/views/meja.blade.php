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
            <form method="POST" action="tambahmeja" class="modal-body">
                @csrf
                <div class="mb-3">
                    <label for="nomor_meja" class="form-label">Nomor meja</label>
                    <input
                        required
                        type="text"
                        name="nomor_meja"
                        id="nomor_meja"
                        class="form-control form-control-lg"
                        placeholder="Nomor meja"
                        aria-describedby="helpId1"
                    />
                    <small id="helpId1" class="text-muted">Masukkan nomor meja</small>
                </div>
                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input
                        required
                        type="number"
                        name="kapasitas"
                        id="kapasitas"
                        class="form-control form-control-lg"
                        placeholder="Kapasitas"
                        aria-describedby="helpId2"
                    />
                    <small id="helpId2" class="text-muted">Masukkan nomor kapasitas</small>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select
                        class="form-select form-select-lg"
                        name="status"
                        id="status"
                    >
                        <option value="Tidak di gunakan">Tidak di gunakan</option>
                        <option value="Sedang di gunakan">Sedang di gunakan</option>
                    </select>
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
<form method="GET" action="/meja" class="col-4" style="float: right; margin-left: auto">
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
                <th scope="col">No</th>
                <th scope="col">Nomor meja</th>
                <th scope="col">Kapasitas</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $key =1;
            @endphp
            @foreach ($data as $item)
            <tr class="">
                <td>{{ $key++ }}</td>
                <td>{{ $item->nomor_meja }}</td>
                <td>{{ $item->kapasitas }}</td>
                <td>
                    @if ($item->status === 'Tidak di gunakan')
                    <form action="status/{{$item->id_meja}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Sedang di gunakan">
                        <button type="submit" class="btn btn-info">Tidak di gunakan</button>
                    </form>
                    @else
                    <form action="status/{{$item->id_meja}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="Tidak di gunakan">
                        <button type="submit" class="btn btn-danger">Sedang di gunakan</button>
                    </form>
                    @endif

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection


