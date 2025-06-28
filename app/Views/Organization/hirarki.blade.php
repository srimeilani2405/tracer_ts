@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Seluruh Hirarki</h3>

    {{-- Navigasi Tab --}}
    <ul class="nav nav-tabs mb-4">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('organisasi/hirarki') ? 'active' : '' }}" href="{{ route('organisasi.hirarki') }}">Seluruh Hirarki</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('organisasi/jurusan') ? 'active' : '' }}" href="{{ route('organisasi.jurusan') }}">Jurusan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('organisasi/program_studi') ? 'active' : '' }}" href="{{ route('organisasi.program_studi') }}">Program Studi</a>
        </li>
    </ul>

    {{-- Cek jika datanya ada --}}
    @if(count($hirarki) > 0)
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Satuan Induk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hirarki as $item)
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['tipe'] }}</td>
                        <td>{{ $item['induk'] ?? '-' }}</td>
                        <td>
                            <a href="#" class="btn btn-info btn-sm">Tinjau</a>
                            <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            <form action="#" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            Belum ada data hirarki yang tersedia.
        </div>
    @endif
</div>
@endsection
