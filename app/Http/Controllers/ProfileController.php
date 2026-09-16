<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile($nama = "", $nim = "", $kelas = "")
    {
        $data = [
            'nama' => $nama ?: 'Bachtiar Nugraha',
            'nim' => $nim ?: '2417051058',
            'kelas' => $kelas ?: 'A',
        ];
        return view('profile', $data);
    }
}
