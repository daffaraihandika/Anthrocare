@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col">
        <h1>Daftar Balita</h1>
    </div>
    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Daftar Balita</a>
            </li>
        </ol>
    </div>
</div>

<div class="mb-3">
    <label for="searchInput" class="form-label">Cari berdasarkan nama/akte/nama orang tua/ktp :</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Enter name">
</div>

<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Bayi</th>
            <th scope="col">Nama Orang Tua</th>
            <th scope="col">Akte</th>
            <th scope="col">Tanggal Lahir Bayi</th>
            <th scope="col">JK</th>
            <th scope="col">Tinggi & Berat Lahir</th>
            <th scope="col">KTP Orang Tua</th>
            <th tanggal_lahir_bayi="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = $data_bayi->firstItem()?>
        @foreach ($data_bayi as $item)
        <tr class="text-center">
            <td>{{ $i }}</td>
            <td>{{ $item->nama_bayi }}</td>
            <td>{{ $item->parents->nama_orangtua }}</td>
            <td>{{ $item->no_akte_bayi }}</td>
            <td>{{ $item->tgl_lahir_bayi }}</td>
            <td>{{ $item->jenis_kelamin }}</td>
            <td>{{ $item->tinggi_lahir }}cm & {{ $item->berat_lahir }}kg</td>
            <td>{{ $item->parents->no_ktp }}</td>
            <td>
                <a href="{{ url('pemeriksaan/periksaInfant/'.$item->id) }}" class="btn mb-2 mb-xl-0">
                    <button class="btn btn-primary">
                        Periksa
                    </button>
                </a>

                <form action="{{ url('pemeriksaan/'.$item->id) }}" class="d-inline" method="POST" onsubmit="return confirm('Apakah anda yakin ingin menghapus data bayi dengan nama {{ $item->nama_bayi }}?')">
                    @csrf
                    @method("DELETE")
                    <button class="btn btn-danger mb-2 mb-xl-0">
                        Hapus
                    </button>
                </form>

                {{-- <a href="" class="btn mb-2 mb-xl-0">
                    <i class="bi bi-archive-fill text-danger"></i>
                </a> --}}
            </td>
        </tr>
        <?php $i++ ?> 
        @endforeach
    </tbody>
</table>

    {{ $data_bayi->links() }}

<script>
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("tbody tr").each(function() {
            var name = $(this).find("td:eq(1)").text()
                .toLowerCase(); // Assuming the name is in the second column (index 1)
            var akte = $(this).find("td:eq(2)").text().toLowerCase();
            var nameParent = $(this).find("td:eq(6)").text().toLowerCase();
            var ktp = $(this).find("td:eq(7)").text().toLowerCase();

            if (name.includes(searchTerm) || akte.includes(searchTerm) || nameParent.includes(
                    searchTerm) || ktp.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>


@endsection