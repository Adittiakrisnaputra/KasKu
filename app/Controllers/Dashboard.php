<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login? Kalau belum, tendang ke login page
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $role = session()->get('role');
        $userId = session()->get('id');

        // Panggil Model
        $transaksiModel = new TransaksiModel();
        $userModel = new UserModel();

        // 2. Hitung Data Statistik Global (Untuk Admin & User melihat Saldo Organisasi)
        // Hitung Total Pemasukan
        $queryMasuk = $transaksiModel->selectSum('jumlah')->where('jenis', 'masuk')->first();
        $totalMasuk = $queryMasuk['jumlah'] ?? 0; // Jika null, anggap 0

        // Hitung Total Pengeluaran
        $queryKeluar = $transaksiModel->selectSum('jumlah')->where('jenis', 'keluar')->first();
        $totalKeluar = $queryKeluar['jumlah'] ?? 0;
        
        // Hitung Saldo Bersih
        $saldo = $totalMasuk - $totalKeluar;

        // Siapkan data dasar
        $data = [
            'title' => 'Dashboard ' . ucfirst($role),
            'nama'  => session()->get('nama'),
            'role'  => $role,
            'saldo_organisasi' => $saldo // Semua role butuh info ini
        ];
        
        // 3. Logika Khusus per Role
        if ($role == 'admin') {
            // --- DATA KHUSUS ADMIN ---
            $data['total_masuk'] = $totalMasuk;
            $data['total_keluar'] = $totalKeluar;
            $data['jumlah_anggota'] = $userModel->where('role', 'user')->countAllResults();
            $data['count_masuk'] = $transaksiModel->where('jenis', 'masuk')->countAllResults();
            $data['count_keluar'] = $transaksiModel->where('jenis', 'keluar')->countAllResults();
            
            // Ambil Daftar Transaksi Terbaru (Urutkan dari yang terbaru)
            // menambahkan JOIN agar nama user terbawa
            $data['riwayat_transaksi'] = $transaksiModel
                ->select('transaksi.*, users.nama_lengkap')
                ->join('users', 'users.id = transaksi.user_id', 'left')
                ->orderBy('transaksi.tanggal', 'DESC')
                ->orderBy('transaksi.created_at', 'DESC')
                ->findAll();

            // Ambil Daftar Anggota Lengkap
            $data['list_anggota'] = $userModel->where('role', 'user')->orderBy('nama_lengkap', 'ASC')->findAll();

            // ============================================================
            // FITUR OTOMATIS: Kirim Tagihan Setiap Tanggal 1 - 5
            // ============================================================
            $tanggalHariIni = date('j'); // Mengambil tanggal hari ini (1-31)
            
            // Cek apakah hari ini tanggal 1 sampai 5 (Periode penagihan)
            if ($tanggalHariIni >= 1 && $tanggalHariIni <= 5) {
                
                $notifikasiModel = new \App\Models\NotifikasiModel();
                $bulanIni = date('F Y');
                $pesanOtomatis = "Halo! Sudah masuk bulan $bulanIni. Jangan lupa bayar iuran kas ya. Terima kasih!";

                // Cek apakah sistem SUDAH pernah kirim notifikasi bulan ini? (Biar tidak spam)
                // cek satu user saja sebagai sampel
                $cekNotif = $notifikasiModel->like('pesan', $bulanIni)->first();

                if (!$cekNotif) {
                    // Kalau belum ada notifikasi bulan ini, KIRIM KE SEMUA ANGGOTA
                    $semuaMember = $userModel->where('role', 'user')->where('status', 'aktif')->findAll();
                    
                    $dataNotifBatch = [];
                    foreach($semuaMember as $member) {
                        $dataNotifBatch[] = [
                            'user_id'     => $member['id'],
                            'pesan'       => $pesanOtomatis,
                            'status_baca' => 'belum',
                            'created_at'  => date('Y-m-d H:i:s')
                        ];
                    }

                    if (!empty($dataNotifBatch)) {
                        $notifikasiModel->insertBatch($dataNotifBatch);
                        // Pasang flashdata biar admin sadar
                        session()->setFlashdata('pesan', "Sistem otomatis mengirim pengingat iuran bulan $bulanIni ke semua anggota.");
                    }
                }
            }

            return view('dashboard/admin', $data);

        } else {
            // --- DATA KHUSUS USER ---
            
            // 1. Statistik Card Hijau (Tetap hitung Iuran Pribadi saja)
            $queryUserMasuk = $transaksiModel->selectSum('jumlah')
                                            ->where('user_id', $userId)
                                            ->where('jenis', 'masuk')
                                            ->first();
            $data['iuran_saya'] = $queryUserMasuk['jumlah'] ?? 0;

            // --- TAMBAHAN BARU: Hitung Pengeluaran Saya (Keluar) ---
            $queryUserKeluar = $transaksiModel->selectSum('jumlah')
                                            ->where('user_id', $userId)
                                            ->where('jenis', 'keluar') // Filter jenis 'keluar'
                                            ->first();
            $data['pengeluaran_saya'] = $queryUserKeluar['jumlah'] ?? 0;

            // 2. Tabel Riwayat Transaksi
            $data['riwayat_transaksi'] = $transaksiModel
                ->select('transaksi.*, users.nama_lengkap') // Pilih semua data transaksi + nama dari tabel users
                ->join('users', 'users.id = transaksi.user_id', 'left') // Gabungkan tabel berdasarkan user_id
                ->orderBy('transaksi.tanggal', 'DESC')
                ->orderBy('transaksi.created_at', 'DESC')
                ->findAll();

            // --- AMBIL DATA NOTIFIKASI USER ---
            $notifikasiModel = new \App\Models\NotifikasiModel();
            
            // Hitung jumlah notifikasi yang BELUM DIBACA (untuk badge merah)
            $data['jumlah_notif'] = $notifikasiModel->where('user_id', $userId)
                                                    ->where('status_baca', 'belum')
                                                    ->countAllResults();

            // Ambil 5 notifikasi terakhir
            $data['list_notif'] = $notifikasiModel->where('user_id', $userId)
                                                  ->orderBy('created_at', 'DESC')
                                                  ->findAll(5);


            return view('dashboard/user', $data);
        }
    }
}