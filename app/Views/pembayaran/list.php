<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
.modern-card {
    border-radius: 20px;
    border: none;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.gradient-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
}

.stat-card {
    border-radius: 20px;
    padding: 1.5rem;
    border: none;
    background: white;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    opacity: 0.1;
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
}

.stat-card:hover::before {
    transform: scale(1.5);
}

.stat-card.warning::before {
    background: #f59e0b;
}

.stat-card.success::before {
    background: #10b981;
}

.stat-card.danger::before {
    background: #ef4444;
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1;
    margin: 0.5rem 0;
}

.modern-tabs {
    border: none;
    background: linear-gradient(to right, #f8f9fa, #ffffff);
    padding: 1rem;
    border-radius: 20px 20px 0 0;
}

.modern-tabs .nav-link {
    border: none;
    border-radius: 50px;
    padding: 0.8rem 1.5rem;
    font-weight: 600;
    color: #64748b;
    transition: all 0.3s ease;
    margin-right: 0.5rem;
}

.modern-tabs .nav-link:hover {
    background: rgba(102, 126, 234, 0.1);
    color: #667eea;
}

.modern-tabs .nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.modern-table {
    border-radius: 15px;
    overflow: hidden;
}

.modern-table thead {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.modern-table thead th {
    border: none;
    padding: 1rem;
    font-weight: 700;
    color: #475569;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
}

.modern-table tbody tr {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f5f9;
}

.modern-table tbody tr:hover {
    background: linear-gradient(to right, #f8f9ff, #ffffff);
    transform: scale(1.01);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.modern-table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border: none;
}

.badge-modern {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.8rem;
}

.btn-action {
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-state-icon {
    font-size: 5rem;
    opacity: 0.3;
    margin-bottom: 1rem;
}

.alert-modern {
    border-radius: 15px;
    border: none;
    padding: 1rem 1.5rem;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    animation: slideDown 0.5s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.navbar-modern {
    background: white !important;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    padding: 1rem 0;
}

.btn-modern {
    border-radius: 50px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 0.9rem;
}

.amount-highlight {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-weight: 800;
}
</style>

<!-- Navbar Modern -->
<nav class="navbar navbar-expand-lg navbar-modern mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            💳 Kelola Pembayaran QR Code
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary btn-modern">
                <i class="bi bi-house"></i> Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="container">
    
    <!-- Alerts -->
    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <span><?= session()->getFlashdata('pesan') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill me-2 fs-5"></i>
                <span><?= session()->getFlashdata('error') ?></span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card warning">
                <div class="stat-icon">⏳</div>
                <div class="text-warning fw-bold mb-1">Menunggu Konfirmasi</div>
                <div class="stat-number text-warning"><?= $count_pending ?></div>
                <small class="text-muted">Pembayaran pending</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card success">
                <div class="stat-icon">✅</div>
                <div class="text-success fw-bold mb-1">Disetujui</div>
                <div class="stat-number text-success"><?= $count_approved ?></div>
                <small class="text-muted">Pembayaran approved</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card danger">
                <div class="stat-icon">❌</div>
                <div class="text-danger fw-bold mb-1">Ditolak</div>
                <div class="stat-number text-danger"><?= $count_rejected ?></div>
                <small class="text-muted">Pembayaran rejected</small>
            </div>
        </div>
    </div>

    <!-- Tabs Section -->
    <div class="card modern-card shadow-sm">
        <div class="modern-tabs">
            <ul class="nav nav-tabs border-0" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#pending">
                        <i class="bi bi-hourglass-split me-1"></i>
                        Pending <span class="badge bg-light text-dark ms-1"><?= $count_pending ?></span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#approved">
                        <i class="bi bi-check-circle me-1"></i>
                        Disetujui <span class="badge bg-light text-dark ms-1"><?= $count_approved ?></span>
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rejected">
                        <i class="bi bi-x-circle me-1"></i>
                        Ditolak <span class="badge bg-light text-dark ms-1"><?= $count_rejected ?></span>
                    </button>
                </li>
            </ul>
        </div>
        
        <div class="card-body p-0">
            <div class="tab-content">
                
                <!-- TAB PENDING -->
                <div class="tab-pane fade show active" id="pending">
                    <?php if (empty($pembayaran_pending)): ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">📭</div>
                            <h5 class="text-muted mb-2">Tidak Ada Pembayaran Pending</h5>
                            <p class="text-muted small">Semua pembayaran sudah diproses</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="modern-table table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Pembayar</th>
                                        <th>Nominal</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembayaran_pending as $p): ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-modern bg-secondary">#<?= $p['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-calendar3 text-muted"></i>
                                                <span><?= date('d M Y', strtotime($p['tanggal_bayar'])) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar bg-primary text-white">
                                                    <?= strtoupper(substr($p['nama_pembayar'], 0, 2)) ?>
                                                </div>
                                                <div>
                                                    <strong><?= esc($p['nama_pembayar']) ?></strong><br>
                                                    <small class="text-muted"><?= esc($p['nama_lengkap'] ?? 'User') ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="amount-highlight fs-6">
                                                Rp <?= number_format($p['nominal'], 0, ',', '.') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted small"><?= esc($p['keterangan']) ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('pembayaran/detail/' . $p['id']) ?>" 
                                               class="btn btn-primary btn-action btn-sm">
                                                <i class="bi bi-eye"></i> Lihat Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- TAB APPROVED -->
                <div class="tab-pane fade" id="approved">
                    <?php if (empty($pembayaran_approved)): ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">✅</div>
                            <h5 class="text-muted mb-2">Belum Ada Pembayaran Disetujui</h5>
                            <p class="text-muted small">Pembayaran yang disetujui akan muncul di sini</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="modern-table table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal Bayar</th>
                                        <th>Pembayar</th>
                                        <th>Nominal</th>
                                        <th>Disetujui Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembayaran_approved as $p): ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-modern bg-success">#<?= $p['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-calendar-check text-success"></i>
                                                <span><?= date('d M Y', strtotime($p['tanggal_bayar'])) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?= esc($p['nama_pembayar']) ?></strong>
                                        </td>
                                        <td>
                                            <div class="amount-highlight fs-6">
                                                Rp <?= number_format($p['nominal'], 0, ',', '.') ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-clock text-muted"></i>
                                                <small class="text-muted"><?= date('d M Y, H:i', strtotime($p['approved_at'])) ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('pembayaran/detail/' . $p['id']) ?>" 
                                               class="btn btn-outline-primary btn-action btn-sm">
                                                <i class="bi bi-file-text"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- TAB REJECTED -->
                <div class="tab-pane fade" id="rejected">
                    <?php if (empty($pembayaran_rejected)): ?>
                        <div class="empty-state">
                            <div class="empty-state-icon">❌</div>
                            <h5 class="text-muted mb-2">Belum Ada Pembayaran Ditolak</h5>
                            <p class="text-muted small">Pembayaran yang ditolak akan muncul di sini</p>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="modern-table table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Pembayar</th>
                                        <th>Nominal</th>
                                        <th>Alasan Ditolak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pembayaran_rejected as $p): ?>
                                    <tr>
                                        <td>
                                            <span class="badge badge-modern bg-danger">#<?= $p['id'] ?></span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <i class="bi bi-calendar-x text-danger"></i>
                                                <span><?= date('d M Y', strtotime($p['tanggal_bayar'])) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <strong><?= esc($p['nama_pembayar']) ?></strong>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-muted">
                                                Rp <?= number_format($p['nominal'], 0, ',', '.') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="alert alert-danger alert-modern py-2 px-3 mb-0 d-inline-block">
                                                <small><?= esc($p['catatan_admin'] ?? 'Tidak ada catatan') ?></small>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('pembayaran/detail/' . $p['id']) ?>" 
                                               class="btn btn-outline-danger btn-action btn-sm">
                                                <i class="bi bi-file-text"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
// Smooth tab transitions
document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
    tab.addEventListener('shown.bs.tab', function (e) {
        e.target.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
});

// Auto dismiss alerts after 5 seconds
setTimeout(() => {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
    });
}, 5000);
</script>

<?= $this->endSection(); ?>