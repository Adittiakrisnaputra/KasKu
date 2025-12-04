<?php

namespace App\Controllers;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\PembayaranModel;

class UploadPembayaran extends BaseController
{
    protected $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
    }

    /**
     * Halaman Upload Bukti Transfer (untuk Anggota)
     */
    public function uploadBukti()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $data['title'] = 'Upload Bukti';
        $data['nama'] = session()->get('nama');
        $data['role'] = session()->get('role');
        
        return view('qris/upload_bukti', $data);
    }

    /**
     * Proses Upload Bukti Transfer
     */
    public function prosesUploadBukti()
    {
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'nama_pembayar' => 'required|min_length[3]',
            'nominal' => 'required|numeric|greater_than[999]',
            'keterangan' => 'required',
            'tanggal_bayar' => 'required',
            'bukti_transfer' => 'uploaded[bukti_transfer]|max_size[bukti_transfer,2048]|is_image[bukti_transfer]'
        ]);

        if (!$this->validate($validation->getRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('bukti_transfer');
        
        if ($file->isValid() && !$file->hasMoved()) {
            
            $uploadPath = WRITEPATH . 'uploads/bukti_transfer';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            $newName = 'bukti_' . time() . '_' . $file->getRandomName();
            $file->move($uploadPath, $newName);

            $data = [
                // PERBAIKAN DISINI: Gunakan 'id', bukan 'user_id'
                'user_id' => session()->get('id'), 
                
                'nama_pembayar' => $this->request->getPost('nama_pembayar'),
                'nominal' => $this->request->getPost('nominal'),
                'keterangan' => $this->request->getPost('keterangan'),
                'bukti_transfer' => $newName,
                'tanggal_bayar' => $this->request->getPost('tanggal_bayar'),
                'status' => 'pending',
                'created_at' => date('Y-m-d H:i:s') // Opsional: Tambah created_at manual jika timestamp model error
            ];

            // Debugging (Opsional): Cek apakah user_id terisi
            if(!$data['user_id']) {
                return redirect()->back()->with('error', 'Gagal: Sesi login tidak valid. Silakan login ulang.');
            }

            if ($this->pembayaranModel->insert($data)) {
                return redirect()->to(base_url('qris/riwayat'))->with('pesan', 'Bukti pembayaran berhasil diupload! Menunggu konfirmasi admin.');
            } else {
                return redirect()->back()->with('error', 'Gagal menyimpan data pembayaran');
            }
        }

        return redirect()->back()->with('error', 'Gagal upload file');
    }

    /**
     * Riwayat Pembayaran User
     */
    public function riwayat()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $userId = session()->get('id');
        
        $data['title'] = 'Riwayat Pembayaran';
        $data['nama'] = session()->get('nama');
        $data['role'] = session()->get('role');
        $data['pembayaran'] = $this->pembayaranModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();
        
        return view('qris/riwayat', $data);
    }

}