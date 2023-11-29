@extends('layouts.main')

@section('container')
<h1>Data Hasil Pemeriksaan Bayi</h1>

    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Hasil Pemeriksaan</a>
            </li>
        </ol>
    </div>

    <div class="row">
        <div class="col-md-9">
            <label for="searchInput" class="form-label">Cari berdasarkan nama/akte/nama orang tua/ktp :</label>

        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Enter name">
        </div>
    </div>
<div class="mb-3">
</div>

<div class="table-responsive">
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
            <?php $i = $data_bayi->firstItem() ?>
            @foreach ($data_bayi as $item)
            <tr class="text-center bg-blue">
                <td>{{ $i }}</td>
                <td>{{$item->nama_bayi}}</td>
                <td>{{$item->no_akte_bayi}}</td>
                <td>{{$item->tgl_lahir_bayi}}</td>
                <td>{{$item->jenis_kelamin}}</td>
                <td>{{ $item->nama_orangtua }}</td>
                <td>{{ $item->no_ktp }}</td>
                <td>
                    <a href="{{ url('hasilPemeriksaan/detail/'.$item->id_infant) }}" class="btn mb-2 mb-xl-0">
                        <button class="btn btn-primary">
                            Detail
                        </button>
                    </a>
                </td>
            </tr>
            <tr id="spacing-row">
                <td></td>
            </tr>
            <?php $i++ ?>
            @endforeach
        </tbody>
    </table>
</div>

{{ $data_bayi->links() }}

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