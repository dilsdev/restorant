@extends('layout.template')
@section('template')
<div
    class="table-responsive-xxl"
>
<form method="GET" action="/pesanan" class="col-4" style="float: right; margin-left: auto">
    <input
        type="search"
        class="form-control"
        name="search"
        id="inputPassword6"
        aria-describedby="helpId"
        placeholder="Search"
    />
</form>
    <table
        class="table table-striped table-hover"
    >
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Pelanggan</th>
                <th scope="col">Meja</th>
                <th scope="col">Karyawan</th>
                <th scope="col">Total harga</th>
                <th scope="col">Detail</th>
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
                <td>{{ $item->nomor_meja }}</td>
                <td>{{ $item->nama_karyawan }}</td>
                <td>Rp.{{ number_format($item->total_harga, 0, ',', '.') }}</td>
                <td>
                    <a
                        name="detail"
                        id="detail"
                        class="btn btn-primary"
                        href="detail/{{ $item->id_pesanan }}"
                        role="button"
                        >Detail</a
                    >

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}

</div>

@endsection
