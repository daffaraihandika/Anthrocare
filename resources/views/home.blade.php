@extends('layouts.main')

@section('container')
    <h1>Selamat Datang di Website Anthrocare</h1>
    <p>Website ini merupakan alat yang dirancang khusus untuk membantu tenaga medis memantau dan mencatat pemeriksaan stunting pada balita dengan menggunakan antropometer. Website ini menyediakan fitur yang praktis dan efisien untuk mencatat data perkembangan balita. Dengan bantuan website ini, para tenaga medis dapat memberikan perawatan yang lebih baik dan tepat untuk mengatasi masalah stunting dan mendukung pertumbuhan yang sehat pada balita.</p>

    <div class="row">
        <div class="col-md-6 border border-3 rounded px-3 py-3 mx-auto mb-3">
            {{-- cara penggunaan --}}
            <span class="title-home">Cara Kerja Anthrocare :</span>
            <ol>
                <li>Orang tua mendaftarkan identitas orang tua dan bayi pada website dibantu oleh petugas</li>
                <li>Jika bayi telah terdaftar maka bayi tersebut bisa langsung diperiksa menggunakan alat Anthrocare</li>
                <li>Anthrocare akan mengambil data jenis kelamin dan usia bayi yang akan diproses dari database.</li>
                <li>Anthrocare akan mengukur panjang badan, berat badan, dan suhu balita,</li>
                <li>Anthrocare akan memproses nilai z-score panjang badan berdasarkan jenis kelamin, usia, dan panjang badan yang telah diukur</li>
                <li>Anthrocare akan mengirim data hasil pengukuran dan hasil perhitungan ke database</li>
                <li>Website akan menampilkan hasil pengukuran tersebut pada halaman pemeriksaan balita</li>
                <li>Website dapat menampilkan hasil pemeriksaan balita tersebut pada halaman pemeriksaan</li>
                <li>Website dapat menghasilkan file pdf dari hasil pemeriksaan balita yang dicetak oleh petugas.</li>
            </ol>
        </div>
        <div class="col-md-6">
            <div class="row border border-3 rounded px-3 py-3 mx-auto mb-3">
                {{-- orang tua --}}
                <div class="col-md-3">
                    {{-- icon --}}
                    <img src="{{ asset('img/parent.png') }}" alt="" style="width: 100%">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <p class="title-home">Data Orang Tua Yang Telah Terdaftar</p>
                    </div>
                    <div class="row">
                        <p class="subtitle-home">{{ $jumlah_data_parent }} Orang Tua</p>
                    </div>
                </div>
            </div>
            
            <div class="row border border-3 rounded px-3 py-3 mx-auto mb-3">
                {{-- bayi --}}
                <div class="col-md-3">
                    {{-- icon --}}
                    <img src="{{ asset('img/infant.png') }}" alt="" style="width: 100%">
                </div>
                <div class="col-md-9">
                    <div class="row">
                        <p class="title-home">Data Bayi Yang Telah Terdaftar</p>
                    </div>
                    <div class="row">
                        <p class="subtitle-home">{{ $jumlah_data_infant }} Bayi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
