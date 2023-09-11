@extends('layouts.main')

@section('container')
<h1>Daftar Orangtua</h1>

<div class="row">
    <div class="col">
        <div class="mb-3">
            <label for="searchInput" class="form-label">Cari berdasarkan nama atau KTP</label>
            <input type="text" class="form-control" id="searchInput" placeholder="Enter name">
        </div>
    </div>
    <div class="col">
        <div class="d-flex flex-column align-items-end mt-auto">
            <h3>
                <a href="{{ url('daftar/add-parent') }}">
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-square-fill"></i>
                        Tambah Orang Tua
                    </button>
                </a>
            </h3>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Orang Tua</th>
            <th scope="col">KTP Orang Tua</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_ortu as $item)
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->nama_orangtua }}</td>
            <td>{{ $item->no_ktp }}</td>
            <td>{{ $item->alamat }}</td>
            <td>
                <a href="{{ url('daftar/add-infant/'.$item->id) }}" class="btn mb-2 mb-xl-0">
                    <button class="btn btn-primary">Tambah Bayi</button>
                </a>
                <a href="" class="btn mb-2 mb-xl-0">
                    <i class="bi bi-archive-fill text-danger"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function() {
    $("#searchInput").on("keyup", function() {
        var searchTerm = $(this).val().toLowerCase();

        $("tbody tr").each(function() {
            var namaOrangTua = $(this).find("td:eq(1)").text()
                .toLowerCase(); // Nama Orang Tua in the second column (index 1)
            var noKtp = $(this).find("td:eq(2)").text()
                .toLowerCase(); // KTP Orang Tua in the third column (index 2)

            // Check if either Nama Orang Tua or No KTP matches the search term
            if (namaOrangTua.includes(searchTerm) || noKtp.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
</script>
@endsection