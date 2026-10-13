<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct(){
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function index(){
        $data = [
            'title' => 'List User',
            'users' => $this->userModel->getUser(),
        ];
        return view('list_user', $data);
    }

    public function create(){
        $kelasModel = new Kelas();
        $kelas = $kelasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas
        ];
        return view('create_user', $data);
    }

    public function store(Request $request){
        $this->userModel->create([
            'nama'     => $request->input('nama'),
            'nim'      => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);
        return redirect()->to('/user')->with('success', 'Data mahasiswa berhasil ditambahkan!');
    }

    public function edit($uuid){
        $user  = UserModel::where('uuid', $uuid)->firstOrFail();
        $kelas = $this->kelasModel->getKelas();
        return view('edit_user', [
            'title' => 'Edit User',
            'user'  => $user,
            'kelas' => $kelas,
        ]);
    }

    public function update(Request $request, $uuid){
        $request->validate([
            'nama'     => 'required|string|max:255',
            'npm'      => 'required|string|max:50',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        try {
            $user = UserModel::where('uuid', $uuid)->firstOrFail();
            $user->update([
                'nama'     => $request->input('nama'),
                'nim'      => $request->input('npm'),
                'kelas_id' => $request->input('kelas_id'),
            ]);
            return redirect()->to('/user')->with('success', 'Data mahasiswa berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data: ' . $e->getMessage());
        }
    }

    public function destroy($uuid){
        try {
            $user = UserModel::where('uuid', $uuid)->firstOrFail();
            $user->delete();
            return redirect()->to('/user')->with('success', 'Data mahasiswa berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->to('/user')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
