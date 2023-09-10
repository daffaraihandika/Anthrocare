@extends('layouts.main')

@section('container')
<h1>Hasil Pemeriksaan Detail Bayi</h1>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col">Nama Bayi : </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">Tanggal Lahir Bayi : </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">Jenis Kelamin Bayi : </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">No Akte Bayi : </div>
            <div class="col">{{ }}</div>
        </div>
        <div class="row">
            <div class="col">Umur : </div>
            <div class="col"> Bulan</div>
        </div>
        <div class="row">
            <div class="col">Nama Orang Tua : </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">Alamat Orang Tua : </div>
            <div class="col"></div>
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
            <td></td>
            <td> C</td>
            <td> Cm</td>
            <td> Kg</td>
            <td></td>
            <td></td>
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
        {{-- @foreach () --}}
        <tr class="text-center">
            <td></td>
            <td> C</td>
            <td> Cm</td>
            <td> Kg</td>
            <td></td>
            <td></td>
        </tr>
        {{-- @endforeach --}}
    </tbody>
</table>

@endsection