<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MataKuliahController extends Controller
{
    public function index(){
        $data = [
            'title' => 'List Mata Kuliah',
            'mks' => Matakuliah::all(),
        ];
        return view('lsit_mk', $data);
    }

    public function create(){
        return view('create_mk', ['title' => 'Create Mata Kuliah']);
    }

    public function store(Request $request){
        Matakuliah::create([
            'nama_mk' => $request->input('nama_mk'),
            'sks' => $request->input('sks')
        ]);

        return redirect()->to('/matakuliah');
    }

    

}
