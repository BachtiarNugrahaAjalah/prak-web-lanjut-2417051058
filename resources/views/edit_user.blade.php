@extends('layouts.app')

@section('title', 'Edit Data Mahasiswa')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

    .edit-page * { font-family: 'Inter', sans-serif; }

    .hero-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3730a3 40%, #7c3aed 100%);
        position: relative;
        overflow: hidden;
    }
    .hero-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 60%);
        animation: shimmer 6s ease-in-out infinite;
    }
    @keyframes shimmer {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(30px, 20px); }
    }

    .glass-card {
        background: rgba(255,255,255,0.97);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        transition: box-shadow 0.3s ease;
    }
    .glass-card:hover {
        box-shadow: 0 32px 60px -12px rgba(0, 0, 0, 0.2);
    }

    .input-field {
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
    }
    .input-field:focus {
        border-color: #6d28d9;
        box-shadow: 0 0 0 4px rgba(109, 40, 217, 0.1);
        outline: none;
    }
    .input-field.error {
        border-color: #ef4444;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
    }

    .label-float {
        position: relative;
    }
    .label-float label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #6b21a8;
        margin-bottom: 6px;
    }

    .btn-update {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-update::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
    }
    .btn-update:hover::before { left: 100%; }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(109, 40, 217, 0.4);
    }
    .btn-update:active { transform: translateY(0); }

    .btn-cancel {
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    .btn-cancel:hover {
        background: linear-gradient(135deg, #e5e7eb, #d1d5db);
        border-color: #9ca3af;
        transform: translateY(-1px);
    }

    .uuid-badge {
        background: linear-gradient(135deg, #ede9fe, #ddd6fe);
        border: 1px solid #c4b5fd;
        font-family: 'Courier New', monospace;
        font-size: 0.7rem;
        letter-spacing: 0.05em;
        color: #6d28d9;
    }

    .form-icon {
        width: 18px;
        height: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .slide-in {
        animation: slideIn 0.5s ease both;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .input-wrapper {
        position: relative;
    }
    .input-wrapper svg {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }
    .input-wrapper input, .input-wrapper select {
        padding-right: 40px;
    }
</style>

<div class="edit-page min-h-screen bg-gradient-to-br from-slate-100 via-violet-50 to-indigo-100">
    {{-- Hero Header --}}
    <div class="hero-header py-8 px-4">
        <div class="max-w-2xl mx-auto relative z-10">
            <a href="{{ url('/user') }}"
               class="inline-flex items-center gap-2 text-white/70 hover:text-white text-sm mb-4 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Daftar
            </a>
            <div class="flex items-center gap-3 mb-2">
                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">Edit Data Mahasiswa</h1>
            </div>
            <p class="text-white/60 text-sm">Perbarui informasi data mahasiswa di bawah ini</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="max-w-2xl mx-auto px-4 -mt-4 pb-12">
        <div class="glass-card rounded-2xl p-8 slide-in">
            {{-- Error Messages --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-red-700 font-semibold text-sm">Terdapat kesalahan pada input:</p>
                    </div>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600 text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.update', $user->uuid) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="label-float">
                    <label for="nama">
                        <svg xmlns="http://www.w3.org/2000/svg" class="form-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Nama Mahasiswa
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="nama" name="nama"
                               value="{{ old('nama', $user->nama) }}"
                               required
                               placeholder="Masukkan nama lengkap"
                               class="input-field {{ $errors->has('nama') ? 'error' : '' }} w-full rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                </div>

                {{-- NPM/NIM --}}
                <div class="label-float">
                    <label for="npm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="form-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2"/>
                        </svg>
                        NPM / NIM
                    </label>
                    <div class="input-wrapper">
                        <input type="text" id="npm" name="npm"
                               value="{{ old('npm', $user->nim) }}"
                               required
                               placeholder="Masukkan NPM/NIM"
                               class="input-field {{ $errors->has('npm') ? 'error' : '' }} w-full rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                </div>

                {{-- Kelas --}}
                <div class="label-float">
                    <label for="kelas_id">
                        <svg xmlns="http://www.w3.org/2000/svg" class="form-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Kelas
                    </label>
                    <select name="kelas_id" id="kelas_id" required
                            class="input-field {{ $errors->has('kelas_id') ? 'error' : '' }} w-full rounded-xl px-4 py-3 text-sm text-gray-800 bg-gray-50 cursor-pointer">
                        <option value="" disabled>-- Pilih Kelas --</option>
                        @foreach ($kelas as $kelasItem)
                            <option value="{{ $kelasItem->id }}"
                                {{ old('kelas_id', $user->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
                                {{ $kelasItem->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Divider --}}
                <div class="border-t border-gray-100 pt-2"></div>

                {{-- Actions --}}
                <div class="flex gap-3">
                    <a href="{{ url('/user') }}"
                       class="btn-cancel flex-1 text-center py-3 px-6 rounded-xl text-sm font-semibold text-gray-600 cursor-pointer">
                        Batal
                    </a>
                    <button type="submit"
                            class="btn-update flex-[2] py-3 px-6 rounded-xl text-white font-semibold text-sm flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
