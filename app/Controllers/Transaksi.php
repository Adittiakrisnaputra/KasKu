<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;

class Transaksi extends BaseController
{
    public function save()
    {
        // 1. Cek Login
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $transaksiModel = new TransaksiModel();

        // Ambil inputan
        $jenis = $this->request->getPost('jenis');
        $jumlah = $this->request->getPost('jumlah');

        // --- LOGIKA VALIDASI SALDO (BARU) ---
        if ($jenis == 'keluar') {
            // Hitung Saldo Saat Ini
            $masuk = $transaksiModel->selectSum('jumlah')->where('jenis', 'masuk')->first()['jumlah'] ?? 0;
            $keluar = $transaksiModel->selectSum('jumlah')->where('jenis', 'keluar')->first()['jumlah'] ?? 0;
            $saldoSaatIni = $masuk - $keluar;

            // Cek apakah saldo cukup?
            if ($jumlah > $saldoSaatIni) {
                // Jika tidak cukup, kirim pesan ERROR
                session()->setFlashdata('error', 'Gagal! Saldo tidak mencukupi. Sisa saldo: Rp ' . number_format($saldoSaatIni, 0, ',', '.'));
                return redirect()->to('/dashboard');
            }
        }
        // ------------------------------------

        // 2. Jika aman, Lanjut Simpan
        $data = [
            'jenis'      => $jenis,
            'user_id'    => $this->request->getPost('user_id') ?: null,
            'jumlah'     => $jumlah,
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal'    => $this->request->getPost('tanggal'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        $transaksiModel->insert($data);

        // Pesan SUKSES
        session()->setFlashdata('pesan', 'Transaksi berhasil disimpan!');
        return redirect()->to('/dashboard');
    }

    // --- FITUR BARU: EDIT TRANSAKSI ---
    public function update()
    {
        // Cek Admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $transaksiModel = new TransaksiModel();
        $id = $this->request->getPost('id');

        $data = [
            'jenis'      => $this->request->getPost('jenis'),
            'user_id'    => $this->request->getPost('user_id') ?: null,
            'jumlah'     => $this->request->getPost('jumlah'),
            'keterangan' => $this->request->getPost('keterangan'),
            'tanggal'    => $this->request->getPost('tanggal'),
        ];

        $transaksiModel->update($id, $data);
        session()->setFlashdata('pesan', 'Transaksi berhasil diperbarui!');
        return redirect()->to('/dashboard');
    }

    // --- FITUR BARU: HAPUS TRANSAKSI ---
    public function delete($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/');
        }

        $transaksiModel = new TransaksiModel();
        $transaksiModel->delete($id);

        session()->setFlashdata('pesan', 'Transaksi berhasil dihapus!');
        return redirect()->to('/dashboard');
    }
}