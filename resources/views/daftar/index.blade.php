@extends('layouts.main')

@section('container')
    <h1>Daftar Orangtua</h1>

    <h3><a href="{{ url('daftar/add-parent') }}">Add Parent</a></h3>

    <ul>


        {{-- href diarahkan ke daftar/add-infant/{parent_id} --}}
        @foreach ($data_ortu as $item)
            <a href="{{ url('daftar/add-infant/'.$item->id) }}">
                <li>{{ $item->nama_orangtua }}</li>
            </a>
        @endforeach
    </ul>
@endsection
