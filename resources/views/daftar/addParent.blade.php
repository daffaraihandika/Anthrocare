@extends('layouts.main')

@section('container')
    <h1>Daftar Balita</h1>

    <form action="{{ route('daftar.add-parent') }}" method="POST">
        @csrf
        <div class="row daftar">
            <div class="col-md-6">
                {{-- Form orang tua --}}
                <h3 class="title">Biodata Orangtua</h3>
                <div class="mb-3">
                    <label for="nama_orangtua" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama_orangtua" aria-describedby="nama" name="nama_orangtua">
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_orangtua" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="tgl_lahir_orangtua" aria-describedby="tanggal-lahir" name="tgl_lahir_orangtua">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat Rumah</label>
                    <input type="text" class="form-control" id="alamat" aria-describedby="alamat" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="no_ktp" class="form-label">No. KTP</label>
                    <input type="number" class="form-control" id="no_ktp" aria-describedby="no-ktp" name="no_ktp">
                </div>
                <div class="mb-3">
                    <label for="gol_darah" class="form-label">Golongan Darah</label>
                    <div class="input-group">
                        <select class="form-select" id="gol_darah" name="gol_darah">
                            <option selected></option>
                            <option value="A">A</option>
                            <option value="B">B</option>
                            <option value="AB">AB</option>
                            <option value="O">O</option>
                        </select>
                    </div>
                </div>                      
                <div class="mb-3">
                    <label for="no_telp" class="form-label">No. Telepon</label>
                    <input type="number" class="form-control" id="no_telp" aria-describedby="no_telp" name="no_telp">
                </div>
            </div>
            
            <div class="mb-4">
                <button class="btn btn-primary btn-daftarSubmit" type="submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
