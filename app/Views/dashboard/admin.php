<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <div class="logo-circle-small me-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 16 16">
                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                </svg>
            </div>
            <span class="fw-bold">KasKu Admin</span>
        </a>
        <div class="d-flex align-items-center">
            <span class="me-3 text-secondary d-none d-md-block">
                <small>Halo, <strong><?= $nama; ?></strong></small>
            </span>
            <a href="<?= base_url('logout') ?>" class="btn btn-modern-danger btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid px-4 py-4">
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </svg>
                <div><strong>Berhasil!</strong> <?= session()->getFlashdata('pesan'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
                <div><?= session()->getFlashdata('error'); ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4 mb-4">
        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card stat-card-success">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Total Pemasukan</p>
                    <h3 class="stat-value">Rp <?= number_format($total_masuk, 0, ',', '.') ?></h3>
                    <small class="stat-meta"><?= $count_masuk ?> Transaksi</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card stat-card-danger">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Total Pengeluaran</p>
                    <h3 class="stat-value">Rp <?= number_format($total_keluar, 0, ',', '.') ?></h3>
                    <small class="stat-meta"><?= $count_keluar ?> Transaksi</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Saldo Saat Ini</p>
                    <h3 class="stat-value">Rp <?= number_format($saldo_organisasi, 0, ',', '.') ?></h3>
                    <small class="stat-meta">Net Balance</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-3">
            <div class="stat-card stat-card-purple">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Total Anggota</p>
                    <h3 class="stat-value"><?= $jumlah_anggota ?></h3>
                    <small class="stat-meta">Orang Terdaftar</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12 col-lg-6">
            <div class="action-card">
                <div class="action-icon action-icon-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h5 class="fw-bold mb-1">Laporan Keuangan Kas</h5>
                    <p class="text-muted mb-3 small">Cetak atau download laporan dalam format PDF</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="<?= base_url('laporanpdf/generatePdf?start_date='.date('Y-m-01', strtotime('first day of last month')).'&end_date='.date('Y-m-t', strtotime('last day of last month'))) ?>" 
                           target="_blank" 
                           class="btn btn-modern-secondary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                            Bulan Lalu
                        </a>
                        <a href="<?= base_url('laporanpdf/generatePdf?start_date='.date('Y-m-01').'&end_date='.date('Y-m-d')) ?>" 
                           target="_blank" 
                           class="btn btn-modern-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                <path d="M8.5 6.5a.5.5 0 0 0-1 0v3.793L6.354 9.146a.5.5 0 1 0-.708.708l2 2a.5.5 0 0 0 .708 0l2-2a.5.5 0 0 0-.708-.708L8.5 10.293V6.5z"/>
                                <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                            </svg>
                            Cetak Bulan Ini
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="action-card">
                <div class="action-icon action-icon-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v1H0V4z"/>
                        <path d="M0 8v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8H0zm3 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm6.5-.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm2 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h5 class="fw-bold mb-1">Kelola Pembayaran QR Code</h5>
                    <p class="text-muted mb-3 small">Approve atau reject pembayaran dari anggota</p>
                    <a href="<?= base_url('pembayaran') ?>" class="btn btn-modern-warning btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                            <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                        </svg>
                        Lihat Pembayaran
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="card modern-card">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center py-3">
            <h5 class="fw-bold mb-0">Manajemen Kas</h5>
            <button class="btn btn-modern-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTransaksi">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Tambah Transaksi
            </button>
        </div>

        <div class="card-body p-0">
            <ul class="nav nav-tabs-modern px-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" type="button">
                        Semua Transaksi
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" type="button">
                        Pemasukan
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" type="button">
                        Pengeluaran
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" id="anggota-tab" data-bs-toggle="tab" data-bs-target="#anggota" type="button">
                        Data Anggota
                    </button>
                </li>
            </ul>

            <div class="tab-content p-4" id="myTabContent">
                <div class="tab-pane fade show active" id="semua" role="tabpanel">
                    <div class="row mb-3 align-items-center g-3">
                        <div class="col-md-6 offset-md-6"> 
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiInput" class="form-control" placeholder="Cari keterangan, nama, atau jumlah...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksi">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($riwayat_transaksi)): ?>
                                    <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data transaksi</td></tr>
                                <?php else: ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                        <td class="fw-semibold">
                                            <?php if ($t['nama_lengkap']): ?>
                                                <?= esc($t['nama_lengkap']) ?>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Anggota (Umum)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($t['keterangan']) ?></td>
                                        <td>
                                            <?php if($t['jenis'] == 'masuk'): ?>
                                                <span class="badge-modern badge-success">Pemasukan</span>
                                            <?php else: ?>
                                                <span class="badge-modern badge-danger">Pengeluaran</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold <?= $t['jenis'] == 'masuk' ? 'text-success' : 'text-danger' ?>">
                                            <?= $t['jenis'] == 'masuk' ? '+' : '-' ?> 
                                            Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <div class="btn-group-action">
                                                <button class="btn-action btn-action-warning btn-edit-transaksi" 
                                                    data-id="<?= $t['id'] ?>"
                                                    data-jenis="<?= $t['jenis'] ?>"
                                                    data-userid="<?= $t['user_id'] ?>"
                                                    data-jumlah="<?= $t['jumlah'] ?>"
                                                    data-keterangan="<?= esc($t['keterangan']) ?>"
                                                    data-tanggal="<?= $t['tanggal'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditTransaksi"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </button>
                                                <a href="<?= base_url('transaksi/delete/'.$t['id']) ?>" 
                                                   class="btn-action btn-action-danger"
                                                   onclick="return confirm('Yakin hapus transaksi ini? Saldo akan berubah.')"
                                                   title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="masuk" role="tabpanel">
                    <div class="row mb-3 align-items-center g-3">
                        <div class="col-md-6 offset-md-6"> 
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiInputMasuk" class="form-control" placeholder="Cari keterangan, nama, atau jumlah pemasukan...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksiMasuk">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($riwayat_transaksi)): ?>
                                    <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data transaksi</td></tr>
                                <?php else: ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                        <td class="fw-semibold">
                                            <?php if ($t['nama_lengkap']): ?>
                                                <?= esc($t['nama_lengkap']) ?>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Anggota (Umum)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($t['keterangan']) ?></td>
                                        <td>
                                            <?php if($t['jenis'] == 'masuk'): ?>
                                                <span class="badge-modern badge-success">Pemasukan</span>
                                            <?php else: ?>
                                                <span class="badge-modern badge-danger">Pengeluaran</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold <?= $t['jenis'] == 'masuk' ? 'text-success' : 'text-danger' ?>">
                                            <?= $t['jenis'] == 'masuk' ? '+' : '-' ?> 
                                            Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <div class="btn-group-action">
                                                <button class="btn-action btn-action-warning btn-edit-transaksi" 
                                                    data-id="<?= $t['id'] ?>"
                                                    data-jenis="<?= $t['jenis'] ?>"
                                                    data-userid="<?= $t['user_id'] ?>"
                                                    data-jumlah="<?= $t['jumlah'] ?>"
                                                    data-keterangan="<?= esc($t['keterangan']) ?>"
                                                    data-tanggal="<?= $t['tanggal'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditTransaksi"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </button>
                                                <a href="<?= base_url('transaksi/delete/'.$t['id']) ?>" 
                                                   class="btn-action btn-action-danger"
                                                   onclick="return confirm('Yakin hapus transaksi ini? Saldo akan berubah.')"
                                                   title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="keluar" role="tabpanel">
                    <div class="row mb-3 align-items-center g-3">
                        <div class="col-md-6 offset-md-6"> 
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiInputKeluar" class="form-control" placeholder="Cari keterangan, nama, atau jumlah pengeluaran...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksiKeluar">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($riwayat_transaksi)): ?>
                                    <tr><td colspan="6" class="text-center text-muted py-5">Belum ada data transaksi</td></tr>
                                <?php else: ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                        <td class="fw-semibold">
                                            <?php if ($t['nama_lengkap']): ?>
                                                <?= esc($t['nama_lengkap']) ?>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Anggota (Umum)</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($t['keterangan']) ?></td>
                                        <td>
                                            <?php if($t['jenis'] == 'masuk'): ?>
                                                <span class="badge-modern badge-success">Pemasukan</span>
                                            <?php else: ?>
                                                <span class="badge-modern badge-danger">Pengeluaran</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="fw-bold <?= $t['jenis'] == 'masuk' ? 'text-success' : 'text-danger' ?>">
                                            <?= $t['jenis'] == 'masuk' ? '+' : '-' ?> 
                                            Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                        </td>
                                        <td>
                                            <div class="btn-group-action">
                                                <button class="btn-action btn-action-warning btn-edit-transaksi" 
                                                    data-id="<?= $t['id'] ?>"
                                                    data-jenis="<?= $t['jenis'] ?>"
                                                    data-userid="<?= $t['user_id'] ?>"
                                                    data-jumlah="<?= $t['jumlah'] ?>"
                                                    data-keterangan="<?= esc($t['keterangan']) ?>"
                                                    data-tanggal="<?= $t['tanggal'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditTransaksi"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </button>
                                                <a href="<?= base_url('transaksi/delete/'.$t['id']) ?>" 
                                                   class="btn-action btn-action-danger"
                                                   onclick="return confirm('Yakin hapus transaksi ini? Saldo akan berubah.')"
                                                   title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="anggota" role="tabpanel">
                    <div class="row mb-3 align-items-center g-3">
                        <div class="col-md-6">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchAnggotaInput" class="form-control" placeholder="Cari nama, username, atau no hp...">
                            </div>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <button class="btn btn-modern-success" data-bs-toggle="modal" data-bs-target="#modalTambahAnggota">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                                Tambah Anggota
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelAnggota">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>No. HP</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($list_anggota)): ?>
                                    <tr><td colspan="6" class="text-center text-muted py-5">Belum ada anggota terdaftar</td></tr>
                                <?php else: ?>
                                    <?php foreach($list_anggota as $u): ?>
                                    <tr>
                                        <td class="fw-semibold"><?= esc($u['nama_lengkap']) ?></td>
                                        <td><?= esc($u['username']) ?></td>
                                        <td>
                                            <?php if($u['role'] == 'admin'): ?>
                                                <span class="badge-modern badge-dark">Administrator</span>
                                            <?php else: ?>
                                                <span class="badge-modern badge-secondary">Anggota</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge-modern <?= $u['status'] == 'aktif' ? 'badge-success' : 'badge-secondary' ?>">
                                                <?= ucfirst($u['status']) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($u['no_hp']) ?></td>
                                        <td>
                                            <div class="btn-group-action">
                                                <button class="btn-action btn-action-info btn-kirim-notif" 
                                                    data-id="<?= $u['id'] ?>"
                                                    data-nama="<?= $u['nama_lengkap'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modalKirimNotif"
                                                    title="Kirim Notifikasi">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                                                    </svg>
                                                </button>
                                                <button class="btn-action btn-action-warning btn-edit-anggota" 
                                                    data-id="<?= $u['id'] ?>"
                                                    data-nama="<?= $u['nama_lengkap'] ?>"
                                                    data-username="<?= $u['username'] ?>"
                                                    data-hp="<?= $u['no_hp'] ?>"
                                                    data-status="<?= $u['status'] ?>"
                                                    data-bs-toggle="modal" data-bs-target="#modalEditAnggota"
                                                    title="Edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                    </svg>
                                                </button>
                                                <a href="<?= base_url('anggota/delete/'.$u['id']) ?>" 
                                                   class="btn-action btn-action-danger"
                                                   onclick="return confirm('Yakin ingin menghapus anggota ini?')"
                                                   title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahTransaksi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Transaksi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('transaksi/save') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Transaksi</label>
                        <select name="jenis" class="form-select form-control-modern" required>
                            <option value="masuk">Pemasukan (Uang Masuk)</option>
                            <option value="keluar">Pengeluaran (Belanja/Kebutuhan)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Anggota (Opsional)</label>
                        <select name="user_id" class="form-select form-control-modern">
                            <option value="">-- Pilih Anggota (Jika Iuran) --</option>
                            <?php foreach($list_anggota as $anggota): ?>
                                <option value="<?= $anggota['id'] ?>"><?= $anggota['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="text-muted">Kosongkan jika ini pengeluaran umum.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control form-control-modern" placeholder="50000" min="1000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-modern" rows="2" placeholder="Bayar kas bulan Mei / Beli Spidol" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control form-control-modern" value="<?= date('Y-m-d'); ?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern-primary">Simpan Transaksi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditTransaksi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('transaksi/update') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_trans_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Transaksi</label>
                        <select name="jenis" class="form-select form-control-modern" id="edit_trans_jenis" required>
                            <option value="masuk">Pemasukan</option>
                            <option value="keluar">Pengeluaran</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Anggota (Opsional)</label>
                        <select name="user_id" class="form-select form-control-modern" id="edit_trans_userid">
                            <option value="">-- Tanpa Anggota (Umum) --</option>
                            <?php foreach($list_anggota as $anggota): ?>
                                <option value="<?= $anggota['id'] ?>"><?= $anggota['nama_lengkap'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jumlah (Rp)</label>
                        <input type="number" name="jumlah" class="form-control form-control-modern" id="edit_trans_jumlah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Keterangan</label>
                        <textarea name="keterangan" class="form-control form-control-modern" id="edit_trans_ket" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control form-control-modern" id="edit_trans_tgl" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern-warning">Update Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTambahAnggota" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Anggota Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('anggota/save') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control form-control-modern" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username (untuk Login)</label>
                        <input type="text" name="username" class="form-control form-control-modern" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP</label>
                        <input type="text" name="no_hp" class="form-control form-control-modern">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password Awal</label>
                        <input type="text" name="password" class="form-control form-control-modern" value="123456" required>
                        <small class="text-muted">Default: 123456</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern-success">Simpan Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEditAnggota" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('anggota/update') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="edit_nama" class="form-control form-control-modern" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <input type="text" name="username" id="edit_username" class="form-control form-control-modern" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP</label>
                        <input type="text" name="no_hp" id="edit_hp" class="form-control form-control-modern">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Akun</label>
                        <select name="status" id="edit_status" class="form-select form-control-modern">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif (Banned)</option>
                        </select>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="form-label text-danger fw-semibold">Reset Password (Opsional)</label>
                        <input type="password" name="password" class="form-control form-control-modern" placeholder="Isi hanya jika ingin ganti password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern-warning">Update Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKirimNotif" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-modern">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Kirim Pesan ke Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= base_url('notifikasi/kirim') ?>" method="post">
                <?= csrf_field(); ?>
                <div class="modal-body">
                    <input type="hidden" name="user_id" id="notif_user_id">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Penerima</label>
                        <input type="text" class="form-control form-control-modern" id="notif_nama_penerima" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Isi Pesan</label>
                        <textarea name="pesan" class="form-control form-control-modern" rows="3" required placeholder="Halo, mohon lunasi iuran bulan ini ya."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-modern-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-modern-info">Kirim Pesan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* ... CSS styles (Dibiarkan sama) ... */
/* Logo Circle Small */
.logo-circle-small {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Statistics Cards */
.stat-card {
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: none;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
}

.stat-card-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
}

.stat-card-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
}

.stat-card-primary {
    background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
}

.stat-card-purple {
    background: linear-gradient(135deg, #e9d5ff 0%, #d8b4fe 100%);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.stat-content {
    flex: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: #6b7280;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
    color: #111827;
}

.stat-meta {
    font-size: 0.75rem;
    color: #9ca3af;
}

/* Action Cards */
.action-card {
    background: linear-gradient(135deg, #ffffff 0%, #fef3c7 100%);
    border-radius: 16px;
    padding: 1.75rem;
    display: flex;
    gap: 1.25rem;
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    transition: transform 0.2s ease;
}

.action-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.action-icon {
    width: 64px;
    height: 64px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.action-icon-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.action-icon-warning {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    color: white;
}

.action-content {
    flex: 1;
}

/* Modern Card */
.modern-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    overflow: hidden;
}

/* Modern Tabs */
.nav-tabs-modern {
    border-bottom: 2px solid #f3f4f6;
}

.nav-tabs-modern .nav-link {
    border: none;
    color: #6b7280;
    padding: 1rem 1.5rem;
    font-weight: 500;
    transition: all 0.2s ease;
    border-bottom: 2px solid transparent;
    margin-bottom: -2px;
}

.nav-tabs-modern .nav-link:hover {
    color: #667eea;
    background: transparent;
}

.nav-tabs-modern .nav-link.active {
    color: #667eea;
    background: transparent;
    border-bottom-color: #667eea;
}

/* Filter Buttons (Sudah dihapus dari HTML, tapi biarkan CSS-nya) */
.filter-group {
    display: inline-flex;
    border-radius: 8px;
    overflow: hidden;
    border: 1px solid #e5e7eb;
}

.btn-filter {
    background: white;
    border: none;
    color: #6b7280;
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    border-right: 1px solid #e5e7eb;
}

.btn-filter:last-child {
    border-right: none;
}

.btn-filter:hover {
    background: #f9fafb;
    color: #374151;
}

.btn-filter.active {
    background: #667eea;
    color: white;
}

/* Search Box */
.search-box {
    position: relative;
}

.search-box svg {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    pointer-events: none;
}

.search-box .form-control {
    padding-left: 40px;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
}

.search-box .form-control:focus {
    background: white;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Modern Table */
.table-modern {
    margin: 0;
}

.table-modern thead {
    background: #f9fafb;
}

.table-modern thead th {
    border-bottom: 2px solid #e5e7eb;
    color: #6b7280;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 1rem;
}

.table-modern tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-bottom: 1px solid #f3f4f6;
}

.table-modern tbody tr:hover {
    background: #f9fafb;
}

.table-scroll {
    max-height: 500px;
    overflow-y: auto;
}

/* Modern Badges */
.badge-modern {
    padding: 0.35rem 0.75rem;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    display: inline-block;
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-danger {
    background: #fee2e2;
    color: #991b1b;
}

.badge-dark {
    background: #e5e7eb;
    color: #1f2937;
}

.badge-secondary {
    background: #f3f4f6;
    color: #6b7280;
}

/* Action Buttons */
.btn-group-action {
    display: flex;
    gap: 0.5rem;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    cursor: pointer;
}

.btn-action-info {
    background: #dbeafe;
    color: #1e40af;
}

.btn-action-info:hover {
    background: #3b82f6;
    color: white;
    transform: translateY(-2px);
}

.btn-action-warning {
    background: #fef3c7;
    color: #92400e;
}

.btn-action-warning:hover {
    background: #f59e0b;
    color: white;
    transform: translateY(-2px);
}

.btn-action-danger {
    background: #fee2e2;
    color: #991b1b;
}

.btn-action-danger:hover {
    background: #ef4444;
    color: white;
    transform: translateY(-2px);
}

/* Modern Buttons */
.btn-modern-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    color: white;
}

.btn-modern-danger {
    background: #ef4444;
    border: none;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-danger:hover {
    background: #dc2626;
    transform: translateY(-2px);
    color: white;
}

.btn-modern-secondary {
    background: #f3f4f6;
    border: none;
    color: #374151;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-secondary:hover {
    background: #e5e7eb;
}

.btn-modern-warning {
    background: #f59e0b;
    border: none;
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-warning:hover {
    background: #d97706;
    transform: translateY(-2px);
}

.btn-modern-success {
    background: #10b981;
    border: none;
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-success:hover {
    background: #059669;
    transform: translateY(-2px);
}

.btn-modern-info {
    background: #3b82f6;
    border: none;
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    font-weight: 600;
    transition: all 0.2s ease;
}

.btn-modern-info:hover {
    background: #2563eb;
    transform: translateY(-2px);
}

/* Modern Form Control */
.form-control-modern {
    padding: 0.65rem 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    background-color: #f9fafb;
    transition: all 0.3s ease;
}

.form-control-modern:focus {
    background-color: white;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    outline: none;
}

/* Modern Modal */
.modal-modern {
    border-radius: 16px;
    overflow: hidden;
}

.modal-modern .modal-header {
    background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
    border-bottom: 1px solid #e5e7eb;
    padding: 1.25rem 1.5rem;
}

.modal-modern .modal-body {
    padding: 1.5rem;
}

.modal-modern .modal-footer {
    background: #f9fafb;
    border-top: 1px solid #e5e7eb;
    padding: 1rem 1.5rem;
}

/* Alert Modern */
.alert-modern {
    border-radius: 12px;
    border: none;
    padding: 1rem 1.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .stat-card {
        padding: 1.25rem;
    }
    
    .stat-value {
        font-size: 1.25rem;
    }
    
    .action-card {
        padding: 1.25rem;
    }
}
</style>

<script>
// Fungsi umum untuk memfilter tabel
function filterTable(tableId, jenis) {
    const rows = document.querySelectorAll(`#${tableId} tbody tr`);
    
    // Reset display for all rows
    rows.forEach(row => row.style.display = '');

    if (jenis === 'all') {
        return;
    }

    rows.forEach(row => {
        // Ambil teks dari badge untuk jenis transaksi
        const badge = row.querySelector('.badge-modern');
        const text = badge ? badge.textContent.toLowerCase() : '';

        // Jika jenis yang dicari tidak ada dalam teks, sembunyikan baris
        if (!text.includes(jenis)) {
            row.style.display = 'none';
        }
    });
}

// Fungsi umum untuk mengatur pencarian
function setupSearch(inputId, tableId) {
    const inputElement = document.getElementById(inputId);
    if (!inputElement) return;

    inputElement.removeEventListener('keyup', searchHandler); // Hapus listener lama jika ada
    
    function searchHandler() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll(`#${tableId} tbody tr`);
        // Pastikan filterTable sudah diterapkan sebelum mencari (untuk kasus tab masuk/keluar)
        
        // Terapkan filter berdasarkan teks
        rows.forEach(row => {
            let text = row.innerText.toLowerCase();
            // Cek apakah baris sudah disembunyikan oleh filterTable (jika ada)
            // Jika filterTable menyembunyikan, biarkan tersembunyi.
            // Jika filterTable tidak menyembunyikan, terapkan pencarian.
            const isFilteredOut = row.style.display === 'none';

            if (!isFilteredOut) {
                row.style.display = text.includes(filter) ? '' : 'none';
            } else if (text.includes(filter)) {
                // Kasus ini adalah untuk memungkinkan pencarian memunculkan kembali baris yang disembunyikan
                // oleh filterTable, tapi ini bisa bentrok dengan logika filterTable.
                // Untuk keamanan, kita harus panggil filterTable() lagi sebelum mencari.
                // Tapi karena di sini hanya keyup, kita harus anggap filterTable sudah berjalan.
                // Agar tidak ribet, kita hanya biarkan search filter dari semua data.
                
                // Cek ulang apakah baris harusnya muncul setelah filter dan search
                const badge = row.querySelector('.badge-modern');
                const badgeText = badge ? badge.textContent.toLowerCase() : '';
                let currentJenis;

                if (tableId === 'tabelTransaksi') currentJenis = 'all';
                else if (tableId === 'tabelTransaksiMasuk') currentJenis = 'pemasukan';
                else if (tableId === 'tabelTransaksiKeluar') currentJenis = 'pengeluaran';
                else currentJenis = 'all';

                const isFilteredByTab = currentJenis === 'all' || badgeText.includes(currentJenis.replace('an',''));

                if (isFilteredByTab) {
                    row.style.display = text.includes(filter) ? '' : 'none';
                }
            }
        });
    }

    inputElement.addEventListener('keyup', searchHandler);
}


document.addEventListener('DOMContentLoaded', function() {
    // 1. Inisialisasi Search untuk Semua Input
    setupSearch('searchTransaksiInput', 'tabelTransaksi'); 
    setupSearch('searchTransaksiInputMasuk', 'tabelTransaksiMasuk');
    setupSearch('searchTransaksiInputKeluar', 'tabelTransaksiKeluar');
    setupSearch('searchAnggotaInput', 'tabelAnggota');
    
    // 2. Inisialisasi Filter untuk Tab yang Aktif saat load (Semua Transaksi)
    filterTable('tabelTransaksi', 'all');

    // 3. Setup Listener untuk Perpindahan Tab
    const tabEl = document.getElementById('myTab');
    tabEl.addEventListener('shown.bs.tab', event => {
        let targetId = event.target.getAttribute('data-bs-target'); 
        
        // Reset Search Input di tab yang baru di-aktifkan
        let inputIdToFocus;
        let tableIdToFilter;

        if (targetId === '#semua') {
            tableIdToFilter = 'tabelTransaksi';
            inputIdToFocus = 'searchTransaksiInput';
            filterTable(tableIdToFilter, 'all');
        } else if (targetId === '#masuk') {
            tableIdToFilter = 'tabelTransaksiMasuk';
            inputIdToFocus = 'searchTransaksiInputMasuk';
            filterTable(tableIdToFilter, 'pemasukan');
        } else if (targetId === '#keluar') {
            tableIdToFilter = 'tabelTransaksiKeluar';
            inputIdToFocus = 'searchTransaksiInputKeluar';
            filterTable(tableIdToFilter, 'pengeluaran');
        } else if (targetId === '#anggota') {
            // Reset filter for Anggota table
            const rowsAnggota = document.querySelectorAll('#tabelAnggota tbody tr');
            rowsAnggota.forEach(row => row.style.display = '');
            document.getElementById('searchAnggotaInput').value = '';
        }
        
        // Kosongkan kolom pencarian tab yang aktif
        if (inputIdToFocus) {
            document.getElementById(inputIdToFocus).value = '';
        }

        // Jalankan filter 'all' pada semua tabel non-aktif untuk memastikan saat diaktifkan lagi datanya full (opsional)
        // Tidak perlu karena filterTable akan dipanggil saat tab diaktifkan.
    });
    
    // ... Existing Modal & Edit Logic (Dibiarkan sama)
    // Edit Transaksi
    const editButtonsTrans = document.querySelectorAll('.btn-edit-transaksi');
    editButtonsTrans.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit_trans_id').value = this.getAttribute('data-id');
            document.getElementById('edit_trans_jenis').value = this.getAttribute('data-jenis');
            document.getElementById('edit_trans_userid').value = this.getAttribute('data-userid');
            document.getElementById('edit_trans_jumlah').value = this.getAttribute('data-jumlah');
            document.getElementById('edit_trans_ket').value = this.getAttribute('data-keterangan');
            document.getElementById('edit_trans_tgl').value = this.getAttribute('data-tanggal');
        });
    });

    // Edit Anggota
    const editButtonsAnggota = document.querySelectorAll('.btn-edit-anggota');
    editButtonsAnggota.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.getAttribute('data-id');
            document.getElementById('edit_nama').value = this.getAttribute('data-nama');
            document.getElementById('edit_username').value = this.getAttribute('data-username');
            document.getElementById('edit_hp').value = this.getAttribute('data-hp');
            document.getElementById('edit_status').value = this.getAttribute('data-status');
        });
    });

    // Kirim Notif
    const btnNotif = document.querySelectorAll('.btn-kirim-notif');
    btnNotif.forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('notif_user_id').value = this.getAttribute('data-id');
            document.getElementById('notif_nama_penerima').value = this.getAttribute('data-nama');
        });
    });

    // Auto hide alerts
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>

<?= $this->endSection(); ?>