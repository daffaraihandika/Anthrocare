@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col">
        <h1>Daftar Orang Tua</h1>
    </div>
    <div class="col d-flex justify-content-end align-items-end" >
        <ol class="breadcrumb">
            <li class="breadcrumb-item " aria-current="page">
                <a href="/daftar" class="text-decoration-none">Pendaftaran</a>
            </li>
            <li class="breadcrumb-item " aria-current="page">
                <a class="text-decoration-none text-secondary">Daftar Orang Tua</a>
            </li>
        </ol>
    </div>
</div>

    <form action="{{ route('daftar.add-parent') }}" method="POST">
        @csrf
        <div class="row daftar">
            <h3 class="title">Biodata Orang Tua</h3>
            <div class="col-md-6">
                {{-- Form orang tua --}}
                <div class="mb-3">
                    <label for="nama_orangtua" class="form-label">Nama</label>
                    <input id="nama_orangtua" type="text" class="form-control @error('nama_orangtua') is-invalid @enderror" placeholder="Nama" name="nama_orangtua" value="{{ old('nama_orangtua') }}">
                                    @error('nama_orangtua') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_orangtua" class="form-label">Tanggal Lahir</label>
                    <input id="tgl_lahir_orangtua" type="date" class="form-control @error('tgl_lahir_orangtua') is-invalid @enderror" placeholder="Tanggal Lahir" name="tgl_lahir_orangtua" value="{{ old('tgl_lahir_orangtua') }}">
                                    @error('tgl_lahir_orangtua') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Rumah</label>
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" placeholder="Alamat" name="alamat" value="{{ old('alamat') }}">
                                    @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="no_ktp" class="form-label">No. KTP</label>
                    <input id="no_ktp" type="number" class="form-control @error('no_ktp') is-invalid @enderror" placeholder="No KTP" name="no_ktp" value="{{ old('no_ktp') }}">
                                    @error('no_ktp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="mb-3">
                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                    <div class="input-group">
                            <select class="form-control select2 @error('gol_darah') is-invalid @enderror" name="gol_darah" id="gol_darah">
                            <option selected></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                    @error('gol_darah`') <span class="text-danger">{{ $message }}</span> @enderror
                </div>                      
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror" placeholder="No Telpon" name="no_telp" value="{{ old('no_telp') }}">
                                    @error('no_telp') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            
            <div class="mb-4">
                <button class="btn btn-primary btn-daftarSubmit" type="submit"><span>Submit</span></button>
            </div>
        </div>
    </form>
@endsection
