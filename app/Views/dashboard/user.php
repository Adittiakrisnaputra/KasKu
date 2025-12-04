<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <div class="logo-circle-small me-2" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" viewBox="0 0 16 16">
                    <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                    <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                </svg>
            </div>
            <span class="fw-bold">KasKu Member</span>
        </a>
        
        <div class="d-flex align-items-center">
            
            <div class="dropdown me-3">
                <a class="text-secondary position-relative" href="#" role="button" id="notifDropdown" data-bs-toggle="dropdown" title="Notifikasi">
                    <span style="font-size: 1.2rem;">🔔</span>
                    <?php if(isset($jumlah_notif) && $jumlah_notif > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                            <?= $jumlah_notif ?>
                        </span>
                    <?php endif; ?>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0" style="width: 300px;">
                    <li class="dropdown-header fw-bold">Notifikasi Anda</li>
                    
                    <?php if(isset($list_notif) && empty($list_notif)): ?>
                        <li><span class="dropdown-item text-muted small">Tidak ada pesan baru</span></li>
                    <?php elseif(isset($list_notif)): ?>
                        <?php foreach($list_notif as $notif): ?>
                            <li class="position-relative border-bottom">
                                <a class="dropdown-item d-flex align-items-start p-2 pe-4" href="<?= base_url('notifikasi/baca/'.$notif['id']) ?>">
                                    <div class="me-2 mt-1">
                                        <?= $notif['status_baca'] == 'belum' ? '🔵' : '⚪' ?>
                                    </div>
                                    <div>
                                        <p class="mb-0 small text-wrap fw-bold"><?= $notif['pesan'] ?></p>
                                        <small class="text-muted" style="font-size: 0.7rem;"><?= date('d M H:i', strtotime($notif['created_at'])) ?></small>
                                    </div>
                                </a>
                                <a href="<?= base_url('notifikasi/hapus/'.$notif['id']) ?>" 
                                   class="position-absolute top-0 end-0 p-2 text-muted text-decoration-none"
                                   style="line-height: 1;"
                                   onclick="return confirm('Hapus pesan ini?')"
                                   title="Hapus notifikasi">
                                    <span style="font-size: 1.2rem; font-weight: bold;">&times;</span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li><a class="dropdown-item text-center small text-primary py-2" href="<?= base_url('notifikasi/bacaSemua') ?>">Tandai semua sudah dibaca</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            
            <span class="me-3 text-secondary d-none d-md-block"><small>Halo, <strong><?= $nama; ?></strong></small></span>
            
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
    
    <div class="row g-4 mb-4">
        
        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card stat-card-success">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2z"/>
                        <path d="M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.504-1.491-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.234 14c.142-.142.274-.3.401-.484.118-.173.23-.374.32-.61.09-.236.168-.492.232-.774a.75.75 0 0 0-.14-.73c-.225-.225-.56-.412-.892-.585-.65-.337-1.353-.702-2.029-1.076C10.638 9.3 10 7.854 10 6c0-1.802-.91-3.486-2.584-4.223C5.972 1.054 4 1.849 4 4c0 1.56.568 3.016 1.458 4.29a12.192 12.192 0 0 1 2.029 1.076c.33.173.665.36.892.585a.75.75 0 0 0 .14.73c-.09.236-.202.437-.32.61-.127.184-.259.342-.401.484z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Iuran Saya (Masuk)</p>
                    <h3 class="stat-value">Rp <?= number_format($iuran_saya, 0, ',', '.') ?></h3>
                    <small class="stat-meta">Total iuran</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card stat-card-danger">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Pengeluaran Saya</p>
                    <h3 class="stat-value">Rp <?= number_format($pengeluaran_saya, 0, ',', '.') ?></h3>
                    <small class="stat-meta">Dana yang pernah saya pakai</small>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4">
            <div class="stat-card stat-card-primary">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                        <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <p class="stat-label">Saldo Kas Kelas</p>
                    <h3 class="stat-value">Rp <?= number_format($saldo_organisasi, 0, ',', '.') ?></h3>
                    <small class="stat-meta">Net Balance (Realtime)</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-12">
            <div class="action-card" style="background: linear-gradient(135deg, #ffffffff 0%, #fef3c7 100%);">
                <div class="action-icon action-icon-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7.35 4.59.001.002.435.272.708-.442c.913-.574 1.545-.985 2-1.385.127-.128.324-.132.555-.187L15 4.02v8a1 1 0 0 0 1 1V4a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a1 1 0 0 0-1-1H2z"/>
                        <path d="M14.5 4.027V12a.5.5 0 0 0 .5.5H2a.5.5 0 0 0 .5-.5V4.027l7.322 4.372 1.464-.908L14.5 4.027z"/>
                    </svg>
                </div>
                <div class="action-content">
                    <h5 class="fw-bold mb-1">📱 Pembayaran Kas via QR Code</h5>
                    <p class="text-muted mb-3 small">Bayar iuran kas dengan mudah menggunakan QR Code.</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="<?= base_url('qris/upload') ?>" 
                        class="btn btn-modern-primary btn-sm">
                            📸 Upload Bukti Bayar
                        </a>
                        <a href="<?= base_url('qris/riwayat') ?>" 
                        class="btn btn-modern-info btn-sm">
                            📋 Riwayat Pembayaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card modern-card">
        <div class="card-header bg-white border-0 py-3">
            <h5 class="fw-bold mb-0">Semua Transaksi Organisasi</h5>
        </div>
        
        <div class="card-body p-0">
            
            <ul class="nav nav-tabs-modern px-4" id="transaksiTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="semua-tab" data-bs-toggle="tab" data-bs-target="#semua" type="button" role="tab">Semua Transaksi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" type="button" role="tab">Pemasukan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" type="button" role="tab">Pengeluaran</button>
                </li>
            </ul>

            <div class="tab-content p-4" id="transaksiTabContent">
                
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6 offset-md-6">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiSemua" class="form-control" placeholder="Cari tanggal, nama, keterangan...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksiSemua">
                            <thead class="position-sticky top-0" style="z-index: 1;">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th> 
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(empty($riwayat_transaksi)): ?>
                                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data transaksi</td></tr>
                                <?php else: ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                        
                                        <td class="fw-semibold">
                                            <?php if ($t['nama_lengkap']): ?>
                                                <?= esc($t['nama_lengkap']) ?>
                                            <?php else: ?>
                                                <span class="text-muted fst-italic">Sistem / Umum</span>
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
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="masuk" role="tabpanel" aria-labelledby="masuk-tab">
                    
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6 offset-md-6">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiMasuk" class="form-control" placeholder="Cari tanggal, nama, keterangan pemasukan...">
                            </div>
                        </div>
                    </div>
                    
                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksiMasuk">
                            <thead class="position-sticky top-0" style="z-index: 1;">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th> 
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $found_masuk = false; ?>
                                <?php if(!empty($riwayat_transaksi)): ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                        <?php if($t['jenis'] == 'masuk'): ?>
                                            <?php $found_masuk = true; ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                                
                                                <td class="fw-semibold">
                                                    <?php if ($t['nama_lengkap']): ?>
                                                        <?= esc($t['nama_lengkap']) ?>
                                                    <?php else: ?>
                                                        <span class="text-muted fst-italic">Sistem / Umum</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= esc($t['keterangan']) ?></td>
                                                
                                                <td><span class="badge-modern badge-success">Pemasukan</span></td>

                                                <td class="fw-bold text-success">
                                                    + Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if(!$found_masuk): ?>
                                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data pemasukan</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="keluar" role="tabpanel" aria-labelledby="keluar-tab">
                    
                    <div class="row mb-3 align-items-center">
                        <div class="col-md-6 offset-md-6">
                            <div class="search-box">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                                <input type="text" id="searchTransaksiKeluar" class="form-control" placeholder="Cari tanggal, nama, keterangan pengeluaran...">
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-scroll">
                        <table class="table table-modern" id="tabelTransaksiKeluar">
                            <thead class="position-sticky top-0" style="z-index: 1;">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama</th> 
                                    <th>Keterangan</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $found_keluar = false; ?>
                                <?php if(!empty($riwayat_transaksi)): ?>
                                    <?php foreach($riwayat_transaksi as $t): ?>
                                        <?php if($t['jenis'] == 'keluar'): ?>
                                            <?php $found_keluar = true; ?>
                                            <tr>
                                                <td><?= date('d/m/Y', strtotime($t['tanggal'])) ?></td>
                                                
                                                <td class="fw-semibold">
                                                    <?php if ($t['nama_lengkap']): ?>
                                                        <?= esc($t['nama_lengkap']) ?>
                                                    <?php else: ?>
                                                        <span class="text-muted fst-italic">Sistem / Umum</span>
                                                    <?php endif; ?>
                                                </td>

                                                <td><?= esc($t['keterangan']) ?></td>
                                                
                                                <td><span class="badge-modern badge-danger">Pengeluaran</span></td>

                                                <td class="fw-bold text-danger">
                                                    - Rp <?= number_format($t['jumlah'], 0, ',', '.') ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if(!$found_keluar): ?>
                                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data pengeluaran</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div> </div> </div> </div>

<style>
    :root {
        --color-primary: #667eea;
        --color-primary-dark: #764ba2;
    }
    
    .logo-circle-small {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Tabs Modern */
    .nav-tabs-modern {
        border-bottom: 2px solid #e5e7eb;
        margin-bottom: 0;
    }
    .nav-tabs-modern .nav-item {
        margin-bottom: -2px; 
    }
    .nav-tabs-modern .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        color: #6b7280;
        font-weight: 600;
        padding: 0.75rem 1rem;
        transition: all 0.2s ease;
    }
    .nav-tabs-modern .nav-link:hover:not(.active) {
        color: #1f2937;
    }
    .nav-tabs-modern .nav-link.active {
        color: var(--color-primary);
        border-bottom-color: var(--color-primary);
        background-color: transparent;
    }

    /* Card Modern */
    .modern-card {
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        border: none;
        overflow: hidden;
    }

    /* Stat Cards */
    .stat-card {
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        border: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease;
    }
    .stat-card:hover { 
        transform: translateY(-4px); 
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1); 
    }
    .stat-card-success { 
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%); 
        color: #065f46;
    }
    .stat-card-danger { 
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%); 
        color: #991b1b;
    }
    .stat-card-primary { 
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%); 
        color: #1e40af;
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
        color: inherit; /* Inherit color from parent stat-card */
    }
    .stat-content { flex: 1; }
    .stat-label { 
        font-size: 0.875rem; 
        color: inherit; /* Inherit color from parent stat-card */
        opacity: 0.8;
        margin-bottom: 0.25rem; 
        font-weight: 500; 
    }
    .stat-value { 
        font-size: 1.5rem; 
        font-weight: 700; 
        margin-bottom: 0.25rem; 
        color: inherit; /* Inherit color from parent stat-card */
    }
    .stat-meta { font-size: 0.75rem; color: inherit; opacity: 0.7; }

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
    .action-icon-warning { 
        background: linear-gradient(135deg, #fcd34d 0%, #fbbf24 100%); 
        color: #78350f; 
    }

    /* Buttons Modern */
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
        box-shadow: 0 4px 8px rgba(118, 75, 162, 0.3);
        transform: translateY(-2px);
        color: white;
    }
    .btn-modern-danger { 
        background: #ef4444; 
        border: none; 
        color: white; 
        padding: 0.5rem 1.25rem; 
        border-radius: 8px; 
        font-weight: 600; 
        transition: all 0.2s ease;
    }
    .btn-modern-danger:hover { 
        background: #dc2626; 
        transform: translateY(-2px); 
        color: white;
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
        color: white;
    }

    /* Search Box */
    .search-box {
        position: relative;
        display: flex;
        align-items: center;
    }
    .search-box svg {
        position: absolute;
        left: 1rem;
        color: #9ca3af;
        z-index: 2;
    }
    .search-box .form-control {
        padding-left: 2.5rem;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
    }
    .search-box .form-control:focus {
        background: white;
        border-color: var(--color-primary);
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    /* Modern Table */
    .table-modern { margin: 0; }
    .table-modern thead { background: #f9fafb; }
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
    .badge-success { background: #d1fae5; color: #065f46; }
    .badge-danger { background: #fee2e2; color: #991b1b; }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .stat-card { padding: 1.25rem; }
        .stat-value { font-size: 1.25rem; }
        .action-card { 
            padding: 1.25rem; 
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .action-card .action-content {
            text-align: center;
        }
    }
</style>

<script>
    /**
     * Fungsi untuk mengatur fitur pencarian per tabel
     */
    function setupTableSearch(inputId, tableId) {
        const inputElement = document.getElementById(inputId);
        const tableBody = document.querySelector(`#${tableId} tbody`);
        
        if (!inputElement || !tableBody) return;

        inputElement.addEventListener('keyup', function() {
            let filterText = this.value.toLowerCase();
            let rows = tableBody.querySelectorAll('tr');
            let dataFound = false;

            rows.forEach(row => {
                // Lewati baris "Belum ada data..."
                if (row.querySelector('td').getAttribute('colspan') === '5') {
                    row.style.display = 'none'; // Selalu sembunyikan placeholder jika ada pencarian
                    return;
                }

                let text = row.innerText.toLowerCase();
                if (text.includes(filterText)) {
                    row.style.display = '';
                    dataFound = true;
                } else {
                    row.style.display = 'none';
                }
            });

            // Tambahkan/perbarui pesan "Tidak ada data ditemukan" jika perlu
            let noDataRow = tableBody.querySelector('.no-search-result');
            if (!dataFound && filterText.length > 0) {
                if (!noDataRow) {
                    noDataRow = tableBody.insertRow();
                    noDataRow.className = 'no-search-result';
                    let cell = noDataRow.insertCell();
                    cell.colSpan = 5;
                    cell.className = 'text-center text-muted py-4';
                    cell.textContent = 'Tidak ada data yang cocok dengan pencarian.';
                }
                noDataRow.style.display = '';
            } else if (noDataRow) {
                 // Hapus pesan "Tidak ada data ditemukan" jika data ditemukan atau filter kosong
                noDataRow.remove(); 
            }
            
            // Tampilkan kembali placeholder jika tidak ada data sama sekali dan filter kosong
            if (!dataFound && filterText.length === 0) {
                const placeholder = tableBody.querySelector('tr:first-child td[colspan="5"]');
                if (placeholder) {
                     placeholder.parentElement.style.display = '';
                }
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Terapkan pencarian untuk SEMUA tabel
        setupTableSearch('searchTransaksiSemua', 'tabelTransaksiSemua'); 
        setupTableSearch('searchTransaksiMasuk', 'tabelTransaksiMasuk');
        setupTableSearch('searchTransaksiKeluar', 'tabelTransaksiKeluar');
    });
</script>

<?= $this->endSection(); ?>