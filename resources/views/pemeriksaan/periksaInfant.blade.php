@extends('layouts.main')

@section('container')
<h1>Data TESSSS</h1>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col">Nama Bayi : </div>
            <div class="col">{{ $identitas_bayi[0]->nama_bayi }}</div>
        </div>
        <div class="row">
            <div class="col">Tanggal Lahir Bayi : </div>
            <div class="col">{{ $identitas_bayi[0]->tgl_lahir_bayi }}</div>
        </div>
        <div class="row">
            <div class="col">Jenis Kelamin Bayi : </div>
            <div class="col">{{ $identitas_bayi[0]->jenis_kelamin }}</div>
        </div>
        <div class="row">
            <div class="col">No Akte Bayi : </div>
            <div class="col">{{ $identitas_bayi[0]->no_akte_bayi}}</div>
        </div>
        <div class="row">
            <div class="col">Umur : </div>
            <div class="col">{{ $identitas_bayi[0]->usia }} Bulan</div>
        </div>
        <div class="row">
            <div class="col">Nama Orang Tua : </div>
            <div class="col">{{ $identitas_bayi[0]->nama_orangtua }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col">asd</div>
            <div class="col">asd</div>
        </div>
    </div>
</div>
<br>
<form action="{{ route()}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3">
                <label for="" class="form-label">Berat Badan</label>
                <input type="text" class="form-control" id="" aria-describedby="" name="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Panjang Badan</label>
                <input type="text" class="form-control" id="" aria-describedby="" name="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Suhu</label>
                <input type="text" class="form-control" id="" aria-describedby="" name="">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Z-Score</label>
                <input type="text" class="form-control" id="" aria-describedby="" name="">
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary btn-daftarSubmit" type="submit">Submit</button>
        </div>
        <div class="col-md-5"></div>
    </div>
</form>
@endsection

<!-- data yang ditampilin di identitas bayi:
- nama bayi
- tgl_lahir_bayi
- jenis kelamin
- no akte bayi
- umur (konversi dari tgl lahir)
- nama orangtua -->


<!-- berat badan
panjang badan
suhu
z-score -->
<!-- si form na ka table pemeriksaan -->