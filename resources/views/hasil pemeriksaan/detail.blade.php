@extends('layouts.main')

@section('container')

<h1>Hasil Pemeriksaan Detail Bayi</h1>
    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a href="/hasilPemeriksaan" class="text-decoration-none">Hasil Pemeriksaan</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Detail</a>
            </li>
        </ol>
    </div>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3">Nama Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Tanggal Lahir Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->tgl_lahir_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Jenis Kelamin Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->jenis_kelamin }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">No Akte Bayi </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->no_akte_bayi}}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Umur </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->usia }} Bulan</div>
        </div>
        <div class="row">
            <div class="col-md-3">Nama Orang Tua  </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_orangtua }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Alamat Orang Tua  </div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->alamat}}</div>
        </div>
    </div>
</div>

{{-- bikin tabel di bawah identitas bayi, 
isi atributnya ada tanggal pemeriksaan, suhu, berat, 
panjang badan, zscore, kondisi --}}
<h1>Riwayat Pemeriksaan Terbaru</h1>
<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Tanggal Pemeriksaan</th>
            <th scope="col">Suhu (Celcius)</th>
            <th scope="col">Berat (Kg)</th>
            <th scope="col">Panjang (Cm)</th>
            <th scope="col">Z-Score</th>
            <th scope="col">Kondisi</th>
        </tr>
    </thead>
    <tbody>
        <tr class="text-center">
            <td>{{$last_inspection->tgl_pemeriksaan}}</td>
            <td>{{$last_inspection->suhu}}°C</td>
            <td>{{$last_inspection->berat}}Kg</td>
            <td>{{$last_inspection->panjang_badan}}Cm</td>
            <td>{{$last_inspection->zscore}}</td>
            <td>{{$last_inspection->kondisi}}</td>
        </tr>
    </tbody>
</table>

<h1>Riwayat Pemeriksaan</h1>
<table class="table">
    <thead>
        <tr class="text-center">
            <th scope="col">Tanggal Pemeriksaan</th>
            <th scope="col">Suhu (Celcius)</th>
            <th scope="col">Berat (Kg)</th>
            <th scope="col">Panjang (Cm)</th>
            <th scope="col">Z-Score</th>
            <th scope="col">Kondisi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_inspection as $item)
        <tr class="text-center">
            <td>{{$item->tgl_pemeriksaan}}</td>
            <td>{{$item->suhu}}°C</td>
            <td>{{$item->berat}}Kg</td>
            <td>{{$item->panjang_badan}}Cm</td>
            <td>{{$item->zscore}}</td>
            <td>{{$item->kondisi}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ url('/hasilPemeriksaan/exportPDF/'.$identitas_bayi[0]->id) }}">
    <button class="btn btn-success">Cetak PDF</button>
</a>

@endsection 