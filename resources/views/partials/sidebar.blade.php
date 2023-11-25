<div class="bg-dark col-auto col-md-2 min-vh-100 sidebar">
    <div class="bg-dark p-2">
        <a href="" class="d-flex text-decoration-none align-items-center mt-1 text-white">
            <span class="fs-4 d-none d-sm-inline">Anthrocare</span>
        </a>

        <ul class="nav nav-pills flex-column mt-4">
            <li class="nav-item">
                <a href="/" class="nav-link text-white {{ $title === 'Home' ? 'active' : '' }}" aria-current="page">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="/daftar" class="nav-link text-white {{ $title === 'Daftar' ? 'active' : '' }}">
                    Pendaftaran
                </a>
                
            </li>
            <li class="nav-item">
                <a href="/pemeriksaan" class="nav-link text-white {{ $title === 'Pemeriksaan' ? 'active' : '' }}">
                    Pemeriksaan Balita
                </a>
            </li>
            <li class="nav-item">
                <a href="/hasilPemeriksaan"
                    class="nav-link text-white {{ $title === 'Hasil Pemeriksaan' ? 'active' : '' }}">
                    Hasil Pemeriksaan
                </a>
            </li>
        </ul>
    </div>

    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <div style="position: absolute; bottom: 30px;" class="bg-dark p-2">
            <button type="submit" class="btn btn-outline-light btn-block">Logout</button>
        </div>
    </form>
</div>