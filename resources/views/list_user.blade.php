@extends('layouts.app')

@section('title', 'Daftar User')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Daftar Pengguna</h1>
        <a href="{{ route('user.create') }}" class="bg-gradient-to-b from-blue-500 to-blue-800 text-white px-4 py-2 rounded-lg shadow-md font-bold text-sm">
            + Tambah User
        </a>
    </div>

    @include('components.data-table', [
        'tableId'   => 'user-table',
        'columns'   => ['Nama', 'NPM', 'Kelas'],
        'fields'    => ['nama', 'nim', 'nama_kelas'],
        'data'      => $users,
        'emptyText' => 'Belum ada data pengguna.'
    ])
</div>
@endsection