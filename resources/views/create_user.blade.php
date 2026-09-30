@extends('layouts.app')

@section('title', 'Buat Pengguna Baru')

@section('content')
<div class="max-w-xl mx-auto py-8 px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Buat Pengguna Baru</h1>
        <a href="{{ url('/user') }}" class="text-sm text-blue-600 hover:underline font-semibold">
            &larr; Kembali ke List
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama:</label>
                <input type="text" id="nama" name="nama" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="npm" class="block text-sm font-medium text-gray-700 mb-1">NPM:</label>
                <input type="text" id="npm" name="npm" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas:</label>
                <select name="kelas_id" id="kelas_id" required
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach ($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="pt-2">
                <button type="submit" 
                    class="w-full bg-gradient-to-b from-blue-500 to-blue-800 text-white py-2 px-4 rounded-lg shadow-md font-bold text-sm hover:opacity-90">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection