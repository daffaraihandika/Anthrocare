@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col">
        <h1>Daftar Bayi</h1>
    </div>
    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a href="/daftar" class="text-decoration-none">Pendaftaran</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Daftar Bayi</a>
            </li>
        </ol>
    </div>
</div>

    <form action="" method="POST">
        @csrf
        <div class="row daftar">

            {{-- form bayi --}}
            <div class="col-md-12">
                <h3 class="title">Biodata Bayi</h3>
                <div class="mb-3">
                    <label for="nama_bayi" class="form-label">Nama</label>
                    <input id="nama_bayi" type="text" class="form-control @error('nama_bayi') is-invalid @enderror" placeholder="Nama" name="nama_bayi" value="{{ old('nama_bayi') }}">
                                    @error('nama_bayi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3 d-none">
                    <label for="id_parent" class="form-label">Nama Orang Tua</label>    
                    <input type="text" class="form-control" id="id_parent" aria-describedby="nama" name="id_parent" readonly value="{{ $namaOrangTua }}">
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_bayi" class="form-label">Tanggal Lahir</label>
                    <input id="tgl_lahir_bayi" type="date" class="form-control @error('tgl_lahir_bayi') is-invalid @enderror "placeholder="Tanggal Lahir" name="tgl_lahir_bayi" value="{{ old('tgl_lahir_bayi') }}">
                    @error('tgl_lahir_bayi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <div class="input-group">
                            <select class="form-control select2 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                            <option selected></option>
                            <option value="Laki - Laki">Laki - Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    @error('jenis_kelamin`') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="no_akte_bayi" class="form-label">No Akte</label>
                    <input id="no_akte_bayi" type="number" class="form-control @error('no_akte_bayi') is-invalid @enderror" placeholder="No Akte" name="no_akte_bayi" value="{{ old('no_akte_bayi') }}">
                    @error('no_akte_bayi') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="tinggi_lahir" class="form-label">Tinggi Lahir (cm)</label>
                    <input id="tinggi_lahir" type="text" class="form-control @error('tinggi_lahir') is-invalid @enderror" placeholder="Tinggi Lahir" name="tinggi_lahir" value="{{ old('tinggi_lahir') }}">
                    @error('tinggi_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                </div>                     
                <div class="mb-3">
                    <label for="berat_lahir" class="form-label">Berat Lahir (kg)</label>
                    <input id="berat_lahir" type="text" class="form-control @error('berat_lahir') is-invalid @enderror" placeholder="Berat Lahir" name="berat_lahir" value="{{ old('berat_lahir') }}">
                    @error('berat_lahir') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
    
            <div class="mb-4">
                <button class="btn btn-primary btn-daftarSubmit" type="submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
