@extends('layouts.main')

@section('container')
<h1>Daftar Orangtua</h1>
<div class="text-end">
    <h3>
        <a href="{{ url('daftar/add-parent') }}">
            <button class="btn btn-primary">
                <i class="bi bi-plus-square-fill"></i>
                Tambah Orang Tua
            </button>
        </a>
    </h3>
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
                    <i class="bi bi-plus-square-fill text-primary"></i>
                </a>
                <a href="" class="btn mb-2 mb-xl-0">
                    <i class="bi bi-archive-fill text-danger"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection