@extends('layouts.main')

@section('container')
<h1>Pemeriksaan Bayi</h1>

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
            <div class="col">
                <button class="btn btn-primary btn-daftarSubmit" type="submit">Send</button>
            </div>
            <div class="col">
                <button class="btn btn-primary btn-daftarSubmit" type="submit">Get</button>
            </div>
        </div>
    </div>
</div>
<br>
<form action="{{ route('pemeriksaan.periksaInfant') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-7">
            <div class="mb-3 d-none">
                <label for="id_infant" class="form-label">Id Bayi</label>
                <input type="text" class="form-control" id="id_infant" aria-describedby="nama" name="id_infant" readonly value="{{ $identitas_bayi[0]->id }}">
            </div>
            <div class="mb-3">
                <label for="berat" class="form-label">Berat Badan (kg)</label>
                <input type="text" class="form-control" id="berat" aria-describedby="" name="berat">
            </div>
            <div class="mb-3">
                <label for="panjang_badan" class="form-label">Panjang Badan (cm)</label>
                <input type="text" class="form-control" id="panjang_badan" aria-describedby="" name="panjang_badan">
            </div>
            <div class="mb-3">
                <label for="suhu" class="form-label">Suhu (celcius)</label>
                <input type="text" class="form-control" id="suhu" aria-describedby="" name="suhu">
            </div>
            <div class="mb-3">
                <label for="zscore" class="form-label">Z-Score (SD)</label>
                <input type="text" class="form-control" id="zscore" aria-describedby="" name="zscore">
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