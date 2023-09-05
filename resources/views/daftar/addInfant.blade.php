@extends('layouts.main')

@section('container')
    <h1>Daftar Balita</h1>

    <form action="/daftar" method="POST">
        @csrf
        <div class="row daftar">

            {{-- form bayi --}}
            <div class="col-md-12">
                <h3 class="title">Biodata Bayi</h3>
                <div class="mb-3">
                    <label for="nama_bayi" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama_bayi" aria-describedby="nama" name="nama_bayi">
                </div>
                <div class="mb-3">
                    <label for="nama_orangtua" class="form-label">Nama Orang Tua</label>
                    <input type="text" class="form-control" id="nama_orangtua" aria-describedby="nama" name="nama_orangtua" readonly value="{{ $namaOrangTua[0] }}">
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_bayi" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir_bayi" aria-describedby="tgl_lahir_bayi" name="tgl_lahir_bayi">
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <div class="input-group">
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            <option selected></option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="no_akte_bayi" class="form-label">No Akte</label>
                    <input type="number" class="form-control" id="no_akte_bayi" aria-describedby="no_akte_bayi" name="no_akte_bayi">
                </div>
                <div class="mb-3">
                    <label for="tinggi_lahir" class="form-label">Tinggi Lahir (cm)</label>
                    <input type="number" class="form-control" id="tinggi_lahir" aria-describedby="tinggi_lahir" name="tinggi_lahir">
                </div>                     
                <div class="mb-3">
                    <label for="berat_lahir" class="form-label">Berat Lahir (kg)</label>
                    <input type="number" class="form-control" id="berat_lahir" aria-describedby="berat_lahir" name="berat_lahir">
                </div>
            </div>
    
            <div class="mb-4">
                <button class="btn btn-primary btn-daftarSubmit" type="submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
