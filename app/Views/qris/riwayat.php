<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
.gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-modern {
    border-radius: 20px;
    border: none;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-modern:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
}

.status-badge {
    padding: 8px 16px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
}

.payment-card {
    background: white;
    border-radius: 16px;
    padding: 20px;
    margin-bottom: 16px;
    border: 2px solid #f0f0f0;
    transition: all 0.3s ease;
}

.payment-card:hover {
    border-color: #667eea;
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.15);
    transform: translateX(5px);
}

.amount-display {
    font-size: 1.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.icon-circle {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.empty-state {
    padding: 60px 20px;
    text-align: center;
}

.empty-state-icon {
    font-size: 5rem;
    opacity: 0.3;
    margin-bottom: 20px;
}

.info-card {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    border-radius: 16px;
    padding: 24px;
    border: none;
}

.navbar-modern {
    background: white !important;
    box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    padding: 1rem 0;
}

.btn-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 10px 24px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
    color: white;
}

.timeline-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    position: absolute;
    left: -6px;
    top: 8px;
}

.payment-meta {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 12px;
}

.payment-meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #6b7280;
    font-size: 0.9rem;
}

@media (max-width: 768px) {
    .payment-card {
        padding: 16px;
    }
    
    .amount-display {
        font-size: 1.25rem;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-modern mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.3rem;">
                💳 Riwayat Pembayaran
            </span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary btn-sm rounded-pill d-none d-md-block">
                ← Dashboard
            </a>
            <span class="me-2 text-secondary d-none d-lg-block">
                Halo, <strong><?= $nama; ?></strong>
            </span>
        </div>
    </div>
</nav>

<div class="container pb-5">
    
    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <span style="font-size: 1.5rem; margin-right: 12px;">✅</span>
                <span><?= session()->getFlashdata('pesan') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">📋 Riwayat Transaksi</h4>
            <p class="text-muted mb-0">Kelola dan pantau semua pembayaran QR Code Anda</p>
        </div>
        <a href="<?= base_url('qris/upload') ?>" class="btn btn-gradient">
            <span class="d-none d-md-inline"> Upload Bukti Baru</span>
            <span class="d-inline d-md-none">📸 Upload</span>
        </a>
    </div>

    <!-- Main Content -->
    <div class="card card-modern shadow-sm">
        <div class="card-body p-4">
            <?php if (empty($pembayaran)): ?>
                <div class="empty-state">
                    <div class="empty-state-icon">🎯</div>
                    <h5 class="fw-bold mb-2">Belum Ada Riwayat Pembayaran</h5>
                    <p class="text-muted mb-4">Mulai lakukan pembayaran via QR Code untuk melihat riwayat di sini</p>
                    <a href="<?= base_url('qris/upload') ?>" class="btn btn-gradient btn-lg">
                        📸 Upload Bukti Pembayaran Pertama
                    </a>
                </div>
            <?php else: ?>
                <!-- Payment Cards List -->
                <div class="payment-list">
                    <?php foreach ($pembayaran as $p): ?>
                    <div class="payment-card">
                        <div class="row align-items-center">
                            <div class="col-auto">
                                <div class="icon-circle" style="background: linear-gradient(135deg, #667eea20 0%, #764ba220 100%);">
                                    <?php if ($p['status'] == 'approved'): ?>
                                        ✅
                                    <?php elseif ($p['status'] == 'pending'): ?>
                                        ⏳
                                    <?php else: ?>
                                        ❌
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <span class="badge bg-light text-dark mb-2">#<?= $p['id'] ?></span>
                                        <h6 class="mb-1 fw-bold"><?= esc($p['keterangan']) ?></h6>
                                    </div>
                                    <div class="text-end">
                                        <?php if ($p['status'] == 'pending'): ?>
                                            <span class="status-badge bg-warning text-dark">⏳ Menunggu</span>
                                        <?php elseif ($p['status'] == 'approved'): ?>
                                            <span class="status-badge bg-success text-white">✅ Disetujui</span>
                                        <?php else: ?>
                                            <span class="status-badge bg-danger text-white">❌ Ditolak</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="amount-display mb-2">
                                    Rp <?= number_format($p['nominal'], 0, ',', '.') ?>
                                </div>
                                
                                <div class="payment-meta">
                                    <div class="payment-meta-item">
                                        <span>📅</span>
                                        <span><?= date('d/m/Y', strtotime($p['tanggal_bayar'])) ?></span>
                                    </div>
                                    <div class="payment-meta-item">
                                        <span>🕐</span>
                                        <span>Upload: <?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></span>
                                    </div>
                                </div>
                                
                                <?php if ($p['status'] == 'rejected' && $p['catatan_admin']): ?>
                                <div class="alert alert-danger mt-3 mb-0 rounded-3 border-0" style="background: #fee2e2;">
                                    <div class="d-flex align-items-start">
                                        <span style="font-size: 1.2rem; margin-right: 10px;">⚠️</span>
                                        <div>
                                            <strong class="d-block mb-1">Alasan Ditolak:</strong>
                                            <span><?= esc($p['catatan_admin']) ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Info Card -->
    <div class="info-card mt-4">
        <h6 class="fw-bold mb-3" style="color: #374151;">
            <span style="font-size: 1.3rem;">💡</span> Informasi Status Pembayaran
        </h6>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="status-badge bg-warning text-dark">⏳ Menunggu</span>
                    <small class="text-muted">Sedang diverifikasi</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="status-badge bg-success text-white">✅ Disetujui</span>
                    <small class="text-muted">Berhasil masuk kas</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2">
                    <span class="status-badge bg-danger text-white">❌ Ditolak</span>
                    <small class="text-muted">Upload ulang bukti</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>