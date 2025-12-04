<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Anggota extends BaseController
{
    // 1. Tambah Anggota Baru
    public function save()
    {
        // Cek admin login
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'         => 'user',
            'status'       => 'aktif',
            'no_hp'        => $this->request->getPost('no_hp'),
            'created_at'   => date('Y-m-d H:i:s')
        ];

        $userModel->insert($data);
        session()->setFlashdata('pesan', 'Anggota berhasil ditambahkan!');
        return redirect()->to('/dashboard');
    }

    // 2. Edit Anggota
    public function update()
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $id = $this->request->getPost('id');

        $data = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'username'     => $this->request->getPost('username'),
            'no_hp'        => $this->request->getPost('no_hp'),
            'status'       => $this->request->getPost('status'),
            'updated_at'   => date('Y-m-d H:i:s')
        ];

        // Cek apakah Admin mengisi password baru? Kalau kosong, jangan diupdate.
        $passwordBaru = $this->request->getPost('password');
        if (!empty($passwordBaru)) {
            $data['password'] = password_hash($passwordBaru, PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);
        session()->setFlashdata('pesan', 'Data anggota berhasil diperbarui!');
        return redirect()->to('/dashboard');
    }

    // 3. Hapus Anggota
    public function delete($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        session()->setFlashdata('pesan', 'Anggota berhasil dihapus!');
        return redirect()->to('/dashboard');
    }
}