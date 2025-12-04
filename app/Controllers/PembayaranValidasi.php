<?php

namespace App\Controllers;

use App\Models\PembayaranModel;
use App\Models\TransaksiModel;

class PembayaranValidasi extends BaseController
{
    protected $pembayaranModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->pembayaranModel = new PembayaranModel();
        $this->transaksiModel = new TransaksiModel();
    }

    /**
     * Daftar Pembayaran Pending (untuk Admin)
     */
    public function index()
    {
        // Cek apakah admin
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $data['nama'] = session()->get('nama');
        $data['role'] = session()->get('role');
        
        // Ambil semua pembayaran dengan join user
        $data['pembayaran_pending'] = $this->pembayaranModel->getPembayaranWithUser('pending');
        $data['pembayaran_approved'] = $this->pembayaranModel->getPembayaranWithUser('approved');
        $data['pembayaran_rejected'] = $this->pembayaranModel->getPembayaranWithUser('rejected');
        
        // Hitung jumlah
        $data['count_pending'] = $this->pembayaranModel->countByStatus('pending');
        $data['count_approved'] = $this->pembayaranModel->countByStatus('approved');
        $data['count_rejected'] = $this->pembayaranModel->countByStatus('rejected');

        return view('pembayaran/list', $data);
    }

    /**
     * Detail Pembayaran + Lihat Bukti Transfer
     */
    public function detail($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $pembayaran = $this->pembayaranModel->find($id);
        
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        $data['nama'] = session()->get('nama');
        $data['role'] = session()->get('role');
        $data['pembayaran'] = $pembayaran;

        return view('pembayaran/detail', $data);
    }

    /**
     * Approve Pembayaran
     */
    public function approve($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $pembayaran = $this->pembayaranModel->find($id);
        
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        if ($pembayaran['status'] != 'pending') {
            return redirect()->back()->with('error', 'Pembayaran sudah diproses sebelumnya');
        }

        $catatan = $this->request->getPost('catatan_admin');
        $adminId = session()->get('user_id');

        // Update status pembayaran
        if ($this->pembayaranModel->approvePembayaran($id, $adminId, $catatan)) {
            
            // Otomatis masukkan ke tabel transaksi
            $dataTransaksi = [
                'user_id' => $pembayaran['user_id'],
                'jenis' => 'masuk',
                'jumlah' => $pembayaran['nominal'],
                'keterangan' => $pembayaran['keterangan'] . ' (Via QR Code) ',
                'tanggal' => $pembayaran['tanggal_bayar'],
                'created_at' => date('Y-m-d H:i:s')
            ];

            $this->transaksiModel->insert($dataTransaksi);

            return redirect()->to(base_url('pembayaran'))->with('pesan', 'Pembayaran berhasil disetujui dan masuk ke transaksi!');
        }

        return redirect()->back()->with('error', 'Gagal menyetujui pembayaran');
    }

    /**
     * Reject Pembayaran
     */
    public function reject($id)
    {
        if (!session()->get('logged_in') || session()->get('role') != 'admin') {
            return redirect()->to('/dashboard')->with('error', 'Akses ditolak!');
        }

        $pembayaran = $this->pembayaranModel->find($id);
        
        if (!$pembayaran) {
            return redirect()->back()->with('error', 'Pembayaran tidak ditemukan');
        }

        if ($pembayaran['status'] != 'pending') {
            return redirect()->back()->with('error', 'Pembayaran sudah diproses sebelumnya');
        }

        $catatan = $this->request->getPost('catatan_admin');
        $adminId = session()->get('user_id');

        if ($this->pembayaranModel->rejectPembayaran($id, $adminId, $catatan)) {
            return redirect()->to(base_url('pembayaran'))->with('pesan', 'Pembayaran berhasil ditolak.');
        }

        return redirect()->back()->with('error', 'Gagal menolak pembayaran');
    }

    /**
     * Lihat Gambar Bukti Transfer
     */
    public function viewBukti($filename)
    {
        $filepath = WRITEPATH . 'uploads/bukti_transfer/' . $filename;
        
        if (!file_exists($filepath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $mime = mime_content_type($filepath);
        
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($filepath));
    }
}