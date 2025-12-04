<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NotifikasiModel;

class Notifikasi extends BaseController
{
    // Admin kirim pesan manual
    public function kirim()
    {
        if (session()->get('role') != 'admin') return redirect()->to('/');

        $model = new NotifikasiModel();
        $model->save([
            'user_id'     => $this->request->getPost('user_id'),
            'pesan'       => $this->request->getPost('pesan'),
            'status_baca' => 'belum',
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        session()->setFlashdata('pesan', 'Notifikasi berhasil dikirim!');
        return redirect()->to('/dashboard');
    }

    // ------------------------------------------------------------------------
    // BAGIAN INI SUDAH DIUBAH AGAR SEMUA NOTIF MASUK KE HALAMAN UPLOAD (FOTO 2)
    // ------------------------------------------------------------------------
    public function baca($id)
    {
        $model = new NotifikasiModel();
        
        // 1. Update status jadi 'sudah dibaca' agar notif tidak muncul sebagai baru terus
        $model->update($id, ['status_baca' => 'sudah']);

        // 2. LANGSUNG REDIRECT (Tanpa Cek Kata Kunci)
        // Apapun isi pesannya, user akan langsung dibawa ke halaman Upload Bukti
        return redirect()->to('/qris/upload');
    }

    // Tandai semua sudah dibaca
    public function bacaSemua()
    {
        $userId = session()->get('id');
        $model = new NotifikasiModel();
        
        $model->where('user_id', $userId)
              ->set(['status_baca' => 'sudah'])
              ->update();

        return redirect()->to('/dashboard');
    }

    // Hapus Notifikasi (Tombol X)
    public function hapus($id)
    {
        $model = new NotifikasiModel();
        
        // Hapus data dari database
        $model->delete($id);
        
        // Kembali ke halaman sebelumnya
        return redirect()->back()->with('pesan', 'Notifikasi berhasil dihapus');
    }
}