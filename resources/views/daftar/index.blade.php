@extends('layouts.main')

@section('container')
    <h1>Daftar Orangtua</h1>

    <ul>
        @foreach ($data_ortu as $item)
            {{-- href diarahkan ke daftar/add-infant/{parent_id} --}}
            <a href="{{ url('daftar/add-infant/'.$item->id) }}">
                <li>{{ $item->nama_orangtua }}</li>
            </a>
        @endforeach
    </ul>
@endsection
