@extends('layout.template')
@section('template')
<div class="d-flex justify-content-center align-items-center">
<div class="card">
    <div class="card-body">
        <h4 class="card-title">detail</h4>
        <div
            class="table-responsive table-responsive-xl"
        >
            <table
                class="table " style="min-width:600px"
            >
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Produk</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $total =0 ;
                        $key = 1;
                    @endphp
                    @foreach ($data as $item)
                    <tr class="">
                        <td>{{ $key++ }}</td>
                        <td>{{ $item->nama_produk }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>{{ $item->subtotal }}</td>
                        @php
                            $total += $item->subtotal;
                        @endphp
                    </tr>
                    @endforeach
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td></td>
                        <td>Rp.{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
            <a
                name="kembali"
                id="kembali"
                class="btn btn-warning"
                href="/pesanan"
                role="button"
                style="float: right"
                >Kembali</a
            >

        </div>

    </div>
</div>
</div>
@endsection
