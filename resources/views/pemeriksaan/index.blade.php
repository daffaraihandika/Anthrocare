@extends('layouts.main')

@section('container')
    <h1>Pemeriksaan</h1>
    <table class="table">
        <thead>
            <tr class="text-center">
                <th scope="col">No</th>
                <th scope="col">Nama Bayi</th>
                <th scope="col">Tanggal Bayi</th>
                <th scope="col">JK</th>
                <th scope="col">Tinggi & Berat Lahir</th>
                <th scope="col">Nama Orang Tua</th>
                <th scope="col">KTP Orang Tua</th>
                <th tanggal_lahir_bayi="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_bayi as $item)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_bayi }}</td>
                <td>{{ $item->tgl_lahir_bayi }}</td>
                <td>{{ $item->jenis_kelamin }}</td>
                <td>{{ $item->tinggi_lahir }}cm & {{ $item->berat_lahir }}kg</td>
                <td>{{ $item->parents->nama_orangtua }}</td>
                <td>{{ $item->parents->no_ktp }}</td>
                <td>
                    <a href="" class="btn mb-2 mb-xl-0">
                        <button class="btn btn-primary">
                            Periksa
                        </button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
