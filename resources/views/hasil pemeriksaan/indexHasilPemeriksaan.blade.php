@extends('layouts.main')

@section('container')
<h1>Data Hasil Pemeriksaan Bayi</h1>

<div class="mb-3">
    <label for="searchInput" class="form-label">Cari berdasarkan nama/akte/nama orang tua/ktp :</label>
    <input type="text" class="form-control" id="searchInput" placeholder="Enter name">
</div>

<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">No</th>
            <th scope="col">Nama Bayi</th>
            <th scope="col">Akte</th>
            <th scope="col">Tanggal Lahir Bayi</th>
            <th scope="col">JK</th>
            <th scope="col">Nama Orang Tua</th>
            <th scope="col">KTP Orang Tua</th>
            <th tanggal_lahir_bayi="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data_bayi as $item)
        <tr class="text-center">
            <td>{{ $loop->iteration }}</td>
            <td>{{$item->nama_bayi}}</td>
            <td>{{$item->no_akte_bayi}}</td>
            <td>{{$item->tgl_lahir_bayi}}</td>
            <td>{{$item->jenis_kelamin}}</td>
            <td>{{ $item->parents->nama_orangtua }}</td>
            <td>{{ $item->parents->no_ktp }}</td>
            <td>
                <a href="{{ url('hasilPemeriksaan/detail/'.$item->id) }}" class="btn mb-2 mb-xl-0">
                    <button class="btn btn-primary">
                        Detail
                    </button>
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
                var name = $(this).find("td:eq(1)").text()
                    .toLowerCase(); // Assuming the name is in the second column (index 1)
                var akte = $(this).find("td:eq(2)").text().toLowerCase();
                var nameParent = $(this).find("td:eq(5)").text().toLowerCase();
                var ktp = $(this).find("td:eq(6)").text().toLowerCase();
    
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