<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = ['title' => 'Login Pengguna'];
        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $session = session();
        $model = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            if (password_verify($password, $pass)) {
                
                // Pastikan status akun adalah 'aktif'. Jika tidak, tolak login.
                if ($data['status'] !== 'aktif') {
                    $session->setFlashdata('error', ' Akun Anda telah diblokir atau dinonaktifkan. Silakan hubungi Administrator.');
                    return redirect()->to('/');
                }

                $ses_data = [
                    'id'       => $data['id'],
                    'username' => $data['username'],
                    'nama'     => $data['nama_lengkap'],
                    'role'     => $data['role'],
                    'logged_in'=> TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/');
        }
    }

    public function register()
    {
        // Jika sudah login, redirect ke dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        $data = ['title' => 'Daftar Akun'];
        return view('auth/register', $data);
    }

    public function registerProcess()
    {
        $model = new UserModel();
        $session = session();

        // Ambil data dari form
        $nama       = $this->request->getPost('nama_lengkap');
        $username   = $this->request->getPost('username');
        $hp         = $this->request->getPost('no_hp');
        $password   = $this->request->getPost('password');
        $password2  = $this->request->getPost('password2');

        // Validasi input kosong
        if (empty($nama) || empty($username) || empty($hp) || empty($password) || empty($password2)) {
            $session->setFlashdata('error', 'Semua field harus diisi!');
            return redirect()->to('/register')->withInput();
        }

        // Validasi panjang username
        if (strlen($username) < 4) {
            $session->setFlashdata('error', 'Username minimal 4 karakter!');
            return redirect()->to('/register')->withInput();
        }

        // Validasi panjang password
        if (strlen($password) < 6) {
            $session->setFlashdata('error', 'Password minimal 6 karakter!');
            return redirect()->to('/register')->withInput();
        }

        // Validasi konfirmasi password
        if ($password != $password2) {
            $session->setFlashdata('error', 'Password tidak sama!');
            return redirect()->to('/register')->withInput();
        }

        // Validasi format nomor HP
        if (!preg_match('/^[0-9]{10,13}$/', $hp)) {
            $session->setFlashdata('error', 'Format nomor HP tidak valid! (10-13 digit)');
            return redirect()->to('/register')->withInput();
        }

        // Cek apakah username sudah digunakan
        if ($model->where('username', $username)->first()) {
            $session->setFlashdata('error', 'Username sudah digunakan!');
            return redirect()->to('/register')->withInput();
        }

        // Cek apakah nomor HP sudah terdaftar
        if ($model->where('no_hp', $hp)->first()) {
            $session->setFlashdata('error', 'Nomor HP sudah terdaftar!');
            return redirect()->to('/register')->withInput();
        }

        // Simpan ke database
        try {
            $model->save([
                'nama_lengkap'  => trim($nama),
                'username'      => strtolower(trim($username)),
                'no_hp'         => $hp,
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'role'          => 'user', 
                'status'        => 'aktif',
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);

            $session->setFlashdata('success', 'Registrasi berhasil! Silakan login');
            return redirect()->to('/');

        } catch (\Exception $e) {
            $session->setFlashdata('error', 'Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->to('/register')->withInput();
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}