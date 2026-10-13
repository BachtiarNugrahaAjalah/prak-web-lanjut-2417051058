@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Mata Kuliah</h1>

    <form action="{{ route('matakuliah.update', $mk->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_mk">Nama Mata Kuliah:</label>
            <input type="text" name="nama_mk" id="nama_mk" value="{{ $mk->nama_mk }}" required>
        </div>

        <div>
            <label for="sks">SKS:</label>
            <input type="number" name="sks" id="sks" value="{{ $mk->sks }}" required>
        </div>

        <button type="submit">Update</button>
    </form>
</div>
@endsection