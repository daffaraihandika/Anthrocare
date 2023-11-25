@extends('layouts.main')

@section('container')
<h1>Identitas Bayi</h1>

<div class="row">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-3">Nama Bayi</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Tanggal Lahir Bayi</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->tgl_lahir_bayi }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Jenis Kelamin Bayi</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->jenis_kelamin }}</div>
        </div>
        <div class="row">
            <div class="col-md-3">No Akte Bayi</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->no_akte_bayi}}</div>
        </div>
        <div class="row">
            <div class="col-md-3">Umur</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->usia }} Bulan</div>
        </div>
        <div class="row">
            <div class="col-md-3">Nama Orang Tua</div>
            <div class="col-md-5">: {{ $identitas_bayi[0]->nama_orangtua }}</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="row">
            <div class="col">
                <form action="{{ route('pemeriksaan.sendData', ['infant' => $identitas_bayi[0]->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3 d-none">
                        <label for="id_infant" class="form-label">Id Bayi</label>
                        <input type="text" class="form-control" id="id_infant" aria-describedby="nama" name="id_infant" readonly
                            value="{{ $identitas_bayi[0]->id }}">
                    </div>
                    <div class="mb-3 d-none">
                        <label for="nama_bayi" class="form-label">Nama Bayi</label>
                        <input type="text" class="form-control" id="nama_bayi" aria-describedby="" name="nama_bayi" value="{{ $identitas_bayi[0]->nama_bayi }}">
                    </div>
                    <div class="mb-3 d-none">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="text" class="form-control" id="usia" aria-describedby="" name="usia" value="{{ $identitas_bayi[0]->usia }}">
                    </div>
                    <div class="mb-3 d-none">
                        <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                        <input type="text" class="form-control" id="jenis_kelamin" aria-describedby="" name="jenis_kelamin" value="{{ $identitas_bayi[0]->jenis_kelamin }}">
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary btn-daftarSubmit" type="submit" >Send</button>
                    </div>
                </form>
            </div>
            <div class="col">
                <a href="{{ url('/pemeriksaan/getData/'.$identitas_bayi[0]->id) }}">
                    <button class="btn btn-primary btn-daftarSubmit" type="submit">Get</button>
                </a>
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
                <input type="text" class="form-control" id="id_infant" aria-describedby="nama" name="id_infant" readonly
                    value="{{ $identitas_bayi[0]->id }}">
            </div>
            <div class="mb-3">
                <label for="berat" class="form-label">Berat Badan (kg)</label>
                <input type="text" class="form-control" id="berat" aria-describedby="" name="berat" value="{{ $result->berat }}">
            </div>
            <div class="mb-3">
                <label for="panjang_badan" class="form-label">Panjang Badan (cm)</label>
                <input type="text" class="form-control" id="panjang_badan" aria-describedby="" name="panjang_badan" value="{{ $result->panjang_badan }}">
            </div>
            <div class="mb-3">
                <label for="suhu" class="form-label">Suhu (celcius)</label>
                <input type="text" class="form-control" id="suhu" aria-describedby="" name="suhu" value="{{ $result->suhu }}">
            </div>
            <div class="mb-3">
                <label for="zscore" class="form-label">Z-Score (SD)</label>
                <input type="text" class="form-control" id="zscore" aria-describedby="" name="zscore" value="{{ $result->zscore }}">
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