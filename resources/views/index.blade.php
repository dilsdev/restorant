@extends('layout.template')
@section('template')
    <div class="card">
        <div class="card-body row">
            <h4 class="card-title">Pesan</h4>
            <form method="POST" action="addkeranjang" class="col-12">
                @csrf
                @if ($data->isEmpty())
                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Pelanggan</label>
                    <select
                    required
                        class="form-select form-select-lg"
                        name="id_pelanggan"
                        id="id_pelanggan"
                    >
                        <option selected>Pilih satu</option>
                        @foreach ($pelanggan as $item4)
                        <option value="{{ $item4->id_pelanggan }}">{{ $item4->nama }}</option>
                        @endforeach
                    </select>
                </div>
                @else
                <div class="mb-3">
                    <label for="id_pelanggan" class="form-label">Pelanggan</label>
                        <input aria-describedby="helpId" class="form-control form-control-lg" value="{{ $data_terakhir->nama }}" type="text" readonly>
                        <small id="helpId" class="text-muted ">*hanya bisa memilih satu pelanggan, hapus keranjang jika inginmemilih pelanggan lain</small>
                        <input id="id_pelanggan"  type="hidden" name="id_pelanggan" value="{{ $data_terakhir->id_pelanggan }}">
                </div>
                @endif


                <div class="mb-3">
                    <label for="id_produk" class="form-label">Produk</label>
                    <select
                    required
                        class="form-select form-select-lg"
                        name="id_produk"
                        id="id_produk"
                        
                    >
                        <option selected>Pilih produk</option>
                        @foreach ($produk as $item5)
                        <option value="{{ $item5->id_produk }}">{{ $item5->nama_produk }}     (sisa {{ $item5->sisa }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="qty" class="form-label">QTY</label>
                    <input required id="qty" value="{{ old('qty') }}" class="form-control" type="number" name="quantity">
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary " style="float: right">add keranjang</button>
                </div>

            </form>
        </div>
    </div>

    <div
        class="table-responsive"
    >
        <table
            class="table table-striped table-hover"
        >
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Produk</th>
                    <th scope="col">QTY</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $total_harga =0;
                @endphp
                @foreach ($data as $item)
                <tr class="">
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nama_produk}}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp.{{ ($item->harga * $item->qty) }}</td>
                    <td>


                    <!-- Modal trigger button -->
                    <button
                        type="button"
                        class="btn btn-warning btn-lg"
                        data-bs-toggle="modal"
                        data-bs-target="#modalId{{ $item->id_keranjang }}"
                    >
                        Edit
                    </button>

                    </td>
                    <div
                        class="modal fade"
                        id="modalId{{ $item->id_keranjang }}"
                        tabindex="-1"
                        data-bs-backdrop="static"
                        data-bs-keyboard="false"

                        role="dialog"
                        aria-labelledby="modalTitleId"
                        aria-hidden="true">
                        <div
                            class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                            role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTitleId">
                                        Edit Quantity
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"
                                    ></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="editqty/{{ $item->id_keranjang }}" class="col-12">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="qty" class="form-label">QTY</label>
                                            <input id="qty" class="form-control" type="number" value="{{ $item->qty }}" name="quantity">
                                        </div>

                                        <div class="modal-footer">
                                            <button
                                                type="submit"
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
                    </div>

                    <script>
                        const myModal = new bootstrap.Modal(
                            document.getElementById("modalId"),
                            options,
                        );
                    </script>
                    <td><form action="hapuskeranjang" method="POST">@csrf @method('DELETE')<input type="hidden" id="id" name="id" value="{{ $item->id_keranjang }}"> <button type="submit" class="btn btn-danger">Hapus</button></form></td>



                    @php
                        $total_harga+=($item->harga * $item->qty);
                    @endphp
                </tr>
                @endforeach
                <tr>
                    <td>Total harga</td>
                    <td></td>
                    <td></td>
                    <td>Rp.{{ $total_harga }}</td>
                    <td></td>
                    <td>


                        <!-- Modal trigger button -->
                        <button
                            type="button"
                            class="btn btn-dark btn-lg"
                            data-bs-toggle="modal"
                            data-bs-target="#modalIdbayar"
                        >
                            Bayar
                        </button>

                        <!-- Modal Body -->
                        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                        <div
                            class="modal fade"
                            id="modalIdbayar"
                            tabindex="-1"
                            data-bs-backdrop="static"
                            data-bs-keyboard="false"

                            role="dialog"
                            aria-labelledby="modalTitleId"
                            aria-hidden="true"
                        >
                            <div
                                class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                role="document"
                            >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitleId">
                                            Bayar Pesanan
                                        </h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"
                                        ></button>
                                    </div>
                                    <form method="POST" action="bayarkeranjang" class="modal-body">
                                        @csrf
                                        <!-- Some borders are removed -->
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Pelanggan :
                                                @if ($data->isEmpty())
                                                -
                                                @else
                                                {{ $data_terakhir->nama }}
                                                @endif
                                            </li>
                                            <li class="list-group-item">Total bayar :Rp.{{ $total_harga }}</li>
                                        </ul>

                                        <div class="mb-3">
                                            <label for="id_meja" class="form-label">Meja</label>
                                            <select
                                                class="form-select form-select-lg"
                                                name="id_meja"
                                                id="id_meja"
                                            >
                                                <option selected>Pilih meja</option>
                                                @foreach ($meja as $item6)
                                                <option  value="{{ $item6->id_meja }}">meja:{{ $item6->nomor_meja }}     kapasitas : {{ $item6->kapasitas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="id_pelanggan" value="
                                        @if ($data->isEmpty())
                                        -
                                        @else
                                        {{ $data_terakhir->id_pelanggan }}
                                        @endif
                                        ">
                                        <input type="hidden" name="id_karyawan" value="{{ session()->get('id_karyawan') }}">
                                        <input type="hidden" name="total" value="{{ $total_harga }}">

                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-bs-dismiss="modal"
                                            >
                                                Close
                                            </button>
                                            @if ($data->isEmpty())

                                                <button disabled type="submit" class="btn btn-primary">Bayar</button>
                                                @else
                                                <button type="submit" class="btn btn-primary">Bayar</button>
                                                @endif
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Optional: Place to the bottom of scripts -->
                        <script>
                            const myModal = new bootstrap.Modal(
                                document.getElementById("modalIdbayar"),
                                options,
                            );
                        </script>



                    </td>
                </tr>
            </tbody>
        </table>
    </div>

@endsection
