@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

    .lu-wrap * { font-family: 'Inter', sans-serif; box-sizing: border-box; }

    /* â”€â”€ Layout â”€â”€ */
    .lu-wrap {
        min-height: 100vh;
        background: #f5f6fa;
        padding: 32px 20px 48px;
    }

    /* â”€â”€ Top bar â”€â”€ */
    .lu-topbar {
        max-width: 960px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .lu-topbar-left h1 {
        font-size: 1.35rem;
        font-weight: 700;
        color: #111827;
        margin: 0 0 2px;
    }
    .lu-topbar-left p {
        font-size: 0.8rem;
        color: #6b7280;
        margin: 0;
    }

    /* â”€â”€ Add button â”€â”€ */
    .btn-add-user {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #4f46e5;
        color: #fff;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        transition: background 0.18s, transform 0.14s;
        white-space: nowrap;
    }
    .btn-add-user:hover { background: #4338ca; transform: translateY(-1px); color: #fff; }

    /* â”€â”€ Card â”€â”€ */
    .lu-card {
        max-width: 960px;
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
    }

    /* â”€â”€ Search bar â”€â”€ */
    .lu-search-bar {
        padding: 14px 18px;
        border-bottom: 1px solid #f3f4f6;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .lu-search-input-wrap {
        position: relative;
        flex: 1;
    }
    .lu-search-input-wrap svg {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
    }
    .lu-search-bar input {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 7px 12px 7px 34px;
        font-size: 0.83rem;
        color: #111827;
        background: #f9fafb;
        outline: none;
        transition: border-color 0.18s, box-shadow 0.18s;
    }
    .lu-search-bar input:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79,70,229,0.1);
        background-color: #fff;
    }
    .lu-count {
        font-size: 0.78rem;
        color: #6b7280;
        white-space: nowrap;
        background: #f3f4f6;
        border-radius: 20px;
        padding: 4px 10px;
    }

    /* â”€â”€ Table â”€â”€ */
    .lu-table {
        width: 100%;
        border-collapse: collapse;
    }
    .lu-table thead tr {
        background: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .lu-table thead th {
        padding: 10px 16px;
        font-size: 0.72rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #6b7280;
        text-align: left;
    }
    .lu-table thead th.center { text-align: center; }

    .lu-table tbody tr {
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.1s;
    }
    .lu-table tbody tr:last-child { border-bottom: none; }
    .lu-table tbody tr:hover { background: #fafafa; }

    .lu-table tbody td {
        padding: 11px 16px;
        font-size: 0.86rem;
        color: #374151;
        vertical-align: middle;
    }

    /* â”€â”€ Row number â”€â”€ */
    .lu-no {
        font-size: 0.78rem;
        color: #9ca3af;
        font-weight: 500;
    }

    /* â”€â”€ Avatar + name â”€â”€ */
    .lu-user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .lu-avatar {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .lu-name { font-weight: 500; color: #111827; }

    /* â”€â”€ NIM â”€â”€ */
    .lu-nim {
        font-family: 'Courier New', monospace;
        font-size: 0.79rem;
        color: #374151;
        background: #f3f4f6;
        padding: 2px 8px;
        border-radius: 5px;
        display: inline-block;
    }

    /* â”€â”€ Kelas tag â”€â”€ */
    .lu-kelas {
        display: inline-block;
        font-size: 0.78rem;
        font-weight: 500;
        color: #4f46e5;
        background: #eef2ff;
        padding: 2px 10px;
        border-radius: 5px;
    }

    /* â”€â”€ Action buttons â”€â”€ */
    .lu-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }
    .lu-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 11px;
        border-radius: 6px;
        font-size: 0.78rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        border: 1px solid transparent;
        transition: background 0.14s, border-color 0.14s;
        white-space: nowrap;
        line-height: 1;
    }
    .lu-btn-edit {
        background: #fff;
        border-color: #d1d5db;
        color: #374151;
    }
    .lu-btn-edit:hover { background: #f3f4f6; border-color: #9ca3af; color: #111827; }
    .lu-btn-del {
        background: #fff;
        border-color: #fca5a5;
        color: #dc2626;
    }
    .lu-btn-del:hover { background: #fef2f2; border-color: #f87171; }

    /* â”€â”€ Empty state â”€â”€ */
    .lu-empty {
        padding: 52px 20px;
        text-align: center;
    }
    .lu-empty svg { color: #d1d5db; margin-bottom: 10px; }
    .lu-empty p  { font-size: 0.88rem; color: #9ca3af; margin: 0; }

    /* â”€â”€ Toast â”€â”€ */
    .lu-toast-wrap {
        position: fixed;
        top: 18px;
        right: 18px;
        z-index: 9000;
        display: flex;
        flex-direction: column;
        gap: 8px;
        pointer-events: none;
    }
    .lu-toast {
        pointer-events: all;
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 260px;
        max-width: 360px;
        padding: 11px 14px;
        border-radius: 9px;
        font-size: 0.83rem;
        font-weight: 500;
        color: #fff;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        animation: toast-in 0.22s ease both;
    }
    .lu-toast.out { animation: toast-out 0.18s ease forwards; }
    @keyframes toast-in  { from { opacity:0; transform:translateX(12px); } to { opacity:1; transform:none; } }
    @keyframes toast-out { to   { opacity:0; transform:translateX(12px); } }
    .lu-toast-ok  { background: #059669; }
    .lu-toast-err { background: #dc2626; }
    .lu-toast-close {
        margin-left: auto;
        background: none;
        border: none;
        color: rgba(255,255,255,0.7);
        cursor: pointer;
        font-size: 0.95rem;
        padding: 0;
        line-height: 1;
    }
    .lu-toast-close:hover { color: #fff; }

    /* â”€â”€ Delete modal â”€â”€ */
    .lu-modal-bg {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        backdrop-filter: blur(3px);
        z-index: 8000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .lu-modal-bg.open { display: flex; }
    .lu-modal {
        background: #fff;
        border-radius: 14px;
        padding: 26px 26px 22px;
        max-width: 370px;
        width: 100%;
        box-shadow: 0 16px 50px rgba(0,0,0,0.15);
        animation: modal-in 0.2s cubic-bezier(0.34,1.56,0.64,1) both;
    }
    @keyframes modal-in { from { opacity:0; transform:scale(0.93) translateY(8px); } to { opacity:1; transform:none; } }
    .lu-modal h2 { font-size: 1rem; font-weight: 700; color: #111827; margin: 0 0 5px; }
    .lu-modal p  { font-size: 0.82rem; color: #6b7280; margin: 0 0 14px; }
    .lu-modal-target {
        background: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 8px;
        padding: 9px 13px;
        margin-bottom: 18px;
    }
    .lu-modal-target strong { display: block; font-size: 0.88rem; color: #b91c1c; }
    .lu-modal-target span   { font-size: 0.75rem; color: #ef4444; font-family: monospace; }
    .lu-modal-footer { display: flex; gap: 8px; }
    .lu-mf-cancel {
        flex: 1;
        padding: 8px;
        border-radius: 7px;
        border: 1px solid #d1d5db;
        background: #f9fafb;
        font-size: 0.83rem;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        transition: background 0.14s;
    }
    .lu-mf-cancel:hover { background: #f3f4f6; }
    .lu-mf-confirm {
        flex: 1;
        padding: 8px;
        border-radius: 7px;
        border: none;
        background: #dc2626;
        color: #fff;
        font-size: 0.83rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.14s;
    }
    .lu-mf-confirm:hover { background: #b91c1c; }
</style>

{{-- Toasts --}}
<div class="lu-toast-wrap">
    @if(session('success'))
        <div class="lu-toast lu-toast-ok" id="lt-ok">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
            <button class="lu-toast-close" onclick="dismissToast('lt-ok')">âœ•</button>
        </div>
    @endif
    @if(session('error'))
        <div class="lu-toast lu-toast-err" id="lt-err">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
            <button class="lu-toast-close" onclick="dismissToast('lt-err')">âœ•</button>
        </div>
    @endif
</div>

{{-- Modal Hapus --}}
<div class="lu-modal-bg" id="delModal">
    <div class="lu-modal">
        <h2>Hapus data ini?</h2>
        <p>Data yang dihapus tidak dapat dikembalikan.</p>
        <div class="lu-modal-target">
            <strong id="dm-name"></strong>
            <span id="dm-nim"></span>
        </div>
        <div class="lu-modal-footer">
            <button class="lu-mf-cancel" onclick="closeModal()">Batal</button>
            <form id="dm-form" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="lu-mf-confirm" style="width:100%">Hapus</button>
            </form>
        </div>
    </div>
</div>

<div class="lu-wrap">

    {{-- Top bar --}}
    <div class="lu-topbar">
        <div class="lu-topbar-left">
            <h1>Daftar Mahasiswa</h1>
            <p>{{ count($users) }} mahasiswa terdaftar</p>
        </div>
        <a href="{{ route('user.create') }}" class="btn-add-user">
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
            </svg>
            Tambah Mahasiswa
        </a>
    </div>

    {{-- Card --}}
    <div class="lu-card">

        {{-- Search bar --}}
        <div class="lu-search-bar">
            <div class="lu-search-input-wrap">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="lu-search" placeholder="Cari nama, NIM, atau kelasâ€¦" oninput="filterTable()">
            </div>
            <span class="lu-count" id="lu-count-label">{{ count($users) }} data</span>
        </div>

        {{-- Table --}}
        <div style="overflow-x:auto">
            <table class="lu-table" id="lu-table">
                <thead>
                    <tr>
                        <th style="width:40px">No</th>
                        <th>Nama</th>
                        <th>NIM / NPM</th>
                        <th>Kelas</th>
                        <th class="center" style="width:140px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $avatarColors = ['#4f46e5','#0891b2','#059669','#d97706','#7c3aed','#db2777','#0284c7'];
                    @endphp
                    @forelse ($users as $i => $user)
                        <tr class="lu-row">
                            <td><span class="lu-no">{{ $i + 1 }}</span></td>
                            <td>
                                <div class="lu-user-cell">
                                    <div class="lu-avatar" style="background:{{ $avatarColors[$i % count($avatarColors)] }}">
                                        {{ strtoupper(substr($user->nama, 0, 1)) }}
                                    </div>
                                    <span class="lu-name">{{ $user->nama }}</span>
                                </div>
                            </td>
                            <td><span class="lu-nim">{{ $user->nim }}</span></td>
                            <td><span class="lu-kelas">{{ $user->nama_kelas }}</span></td>
                            <td>
                                <div class="lu-actions">
                                    <a href="{{ route('user.edit', $user->uuid) }}" class="lu-btn lu-btn-edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Edit
                                    </a>
                                    <button type="button" class="lu-btn lu-btn-del"
                                        onclick="openModal('{{ route('user.destroy', $user->uuid) }}','{{ addslashes($user->nama) }}','{{ $user->nim }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="lu-empty">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    <p>Belum ada data mahasiswa.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
function filterTable() {
    const q    = document.getElementById('lu-search').value.toLowerCase();
    const rows = document.querySelectorAll('#lu-table tbody tr.lu-row');
    let n = 0;
    rows.forEach(r => {
        const show = r.textContent.toLowerCase().includes(q);
        r.style.display = show ? '' : 'none';
        if (show) n++;
    });
    document.getElementById('lu-count-label').textContent = n + ' data';
}

function dismissToast(id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add('out');
    setTimeout(() => el.remove(), 200);
}
document.addEventListener('DOMContentLoaded', () => {
    ['lt-ok','lt-err'].forEach(id => {
        const el = document.getElementById(id);
        if (el) setTimeout(() => dismissToast(id), 4000);
    });
});

function openModal(url, name, nim) {
    document.getElementById('dm-form').action = url;
    document.getElementById('dm-name').textContent = name;
    document.getElementById('dm-nim').textContent  = nim;
    document.getElementById('delModal').classList.add('open');
}
function closeModal() {
    document.getElementById('delModal').classList.remove('open');
}
document.getElementById('delModal').addEventListener('click', e => {
    if (e.target === e.currentTarget) closeModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
@endsection
