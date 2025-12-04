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
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
}

.gradient-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.info-row {
    padding: 1rem 0;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s ease;
}

.info-row:hover {
    background-color: #f8f9ff;
    padding-left: 0.5rem;
}

.info-row:last-child {
    border-bottom: none;
}

.info-label {
    color: #64748b;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
}

.info-value {
    color: #1e293b;
    font-size: 1rem;
}

.amount-display {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    padding: 1.5rem;
    border-radius: 15px;
    color: white;
    text-align: center;
    margin: 1rem 0;
}

.action-btn {
    padding: 0.8rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.image-preview {
    border-radius: 15px;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.image-preview:hover {
    transform: scale(1.02);
}

.tips-card {
    background: linear-gradient(135deg, #eef2ff 0%, #e0e7ff 100%);
    border-radius: 15px;
    padding: 1.5rem;
    border: none;
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
}

.btn-modern:hover {
    transform: translateY(-2px);
}

.textarea-modern {
    border-radius: 15px;
    border: 2px solid #e2e8f0;
    padding: 1rem;
    transition: border-color 0.3s ease;
}

.textarea-modern:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

.alert-modern {
    border-radius: 15px;
    border: none;
    padding: 1rem;
}
</style>

<!-- Navbar Modern -->
<nav class="navbar navbar-expand-lg navbar-modern mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            💳 Detail Pembayaran
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('pembayaran') ?>" class="btn btn-outline-secondary btn-modern">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row g-4">
        <!-- Kolom Kiri: Detail Pembayaran -->
        <div class="col-lg-7">
            <!-- Card Informasi Pembayaran -->
            <div class="card modern-card shadow-sm">
                <div class="gradient-header text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">📋 Informasi Pembayaran</h5>
                        <span class="badge bg-white text-primary">#<?= $pembayaran['id'] ?></span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <?php if ($pembayaran['status'] == 'pending'): ?>
                            <span class="status-badge bg-warning text-dark">
                                <span class="spinner-border spinner-border-sm" role="status"></span>
                                Menunggu Konfirmasi
                            </span>
                        <?php elseif ($pembayaran['status'] == 'approved'): ?>
                            <span class="status-badge bg-success text-white">
                                <i class="bi bi-check-circle-fill"></i>
                                Disetujui
                            </span>
                        <?php else: ?>
                            <span class="status-badge bg-danger text-white">
                                <i class="bi bi-x-circle-fill"></i>
                                Ditolak
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Nominal Display -->
                    <div class="amount-display">
                        <div class="small mb-1 opacity-75">Total Pembayaran</div>
                        <div class="fs-2 fw-bold">
                            Rp <?= number_format($pembayaran['nominal'], 0, ',', '.') ?>
                        </div>
                    </div>

                    <!-- Info Rows -->
                    <div class="info-row">
                        <div class="info-label">👤 Nama Pembayar</div>
                        <div class="info-value fw-bold"><?= esc($pembayaran['nama_pembayar']) ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">📝 Keterangan</div>
                        <div class="info-value"><?= esc($pembayaran['keterangan']) ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">📅 Tanggal Pembayaran</div>
                        <div class="info-value"><?= date('d F Y', strtotime($pembayaran['tanggal_bayar'])) ?></div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">⏰ Waktu Upload</div>
                        <div class="info-value"><?= date('d F Y, H:i', strtotime($pembayaran['created_at'])) ?> WIB</div>
                    </div>
                    
                    <?php if ($pembayaran['status'] != 'pending'): ?>
                    <div class="info-row">
                        <div class="info-label">✅ Diproses Pada</div>
                        <div class="info-value"><?= date('d F Y, H:i', strtotime($pembayaran['approved_at'])) ?> WIB</div>
                    </div>
                    
                    <?php if ($pembayaran['catatan_admin']): ?>
                    <div class="info-row">
                        <div class="info-label">💬 Catatan Admin</div>
                        <div class="alert alert-modern alert-info mt-2 mb-0">
                            <?= esc($pembayaran['catatan_admin']) ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Form Aksi (untuk status pending) -->
            <?php if ($pembayaran['status'] == 'pending'): ?>
            <div class="card modern-card shadow-sm mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color: #667eea;">⚙️ Aksi Verifikasi</h6>
                    
                    <!-- Form Approve -->
                    <form action="<?= base_url('pembayaran/approve/' . $pembayaran['id']) ?>" method="post" class="mb-3">
                        <?= csrf_field() ?>
                        <label class="form-label fw-bold text-success">✅ Setujui Pembayaran</label>
                        <textarea name="catatan_admin" class="form-control textarea-modern mb-3" rows="2" placeholder="Tambahkan catatan (opsional)..."></textarea>
                        <button type="submit" class="btn btn-success action-btn w-100" onclick="return confirm('Yakin menyetujui pembayaran ini?')">
                            <i class="bi bi-check-circle"></i>
                            Setujui Pembayaran
                        </button>
                    </form>

                    <div class="position-relative my-4">
                        <hr>
                        <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small">atau</span>
                    </div>

                    <!-- Form Reject -->
                    <form action="<?= base_url('pembayaran/reject/' . $pembayaran['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <label class="form-label fw-bold text-danger">❌ Tolak Pembayaran</label>
                        <textarea name="catatan_admin" class="form-control textarea-modern mb-3" rows="2" placeholder="Alasan penolakan (wajib)..." required></textarea>
                        <button type="submit" class="btn btn-danger action-btn w-100" onclick="return confirm('Yakin menolak pembayaran ini?')">
                            <i class="bi bi-x-circle"></i>
                            Tolak Pembayaran
                        </button>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- Kolom Kanan: Bukti Transfer -->
        <div class="col-lg-5">
            <!-- Card Bukti Transfer -->
            <div class="card modern-card shadow-sm">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border: none; padding: 1.5rem;">
                    <h5 class="mb-0 fw-bold">📸 Bukti Transfer</h5>
                </div>
                <div class="card-body p-4 text-center">
                    <?php if ($pembayaran['bukti_transfer']): ?>
                        <div class="image-preview mb-3" onclick="openImageModal('<?= base_url('pembayaran/viewBukti/' . $pembayaran['bukti_transfer']) ?>')">
                            <img src="<?= base_url('pembayaran/viewBukti/' . $pembayaran['bukti_transfer']) ?>" 
                                 alt="Bukti Transfer" 
                                 class="img-fluid">
                        </div>
                        
                        <a href="<?= base_url('pembayaran/viewBukti/' . $pembayaran['bukti_transfer']) ?>" 
                           target="_blank" 
                           class="btn btn-outline-primary btn-modern">
                            <i class="bi bi-arrows-fullscreen"></i>
                            Lihat Ukuran Penuh
                        </a>
                    <?php else: ?>
                        <div class="alert alert-modern alert-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            Tidak ada bukti transfer
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Tips Verifikasi -->
            <div class="tips-card mt-4">
                <h6 class="fw-bold mb-3" style="color: #667eea;">
                    <i class="bi bi-lightbulb-fill"></i> Tips Verifikasi
                </h6>
                <div class="d-flex flex-column gap-2">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                        <span class="small">Pastikan nominal sesuai dengan yang tertera</span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                        <span class="small">Periksa tanggal dan waktu transaksi</span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                        <span class="small">Verifikasi nama penerima dan pengirim</span>
                    </div>
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-check-circle-fill text-primary mt-1"></i>
                        <span class="small">Pastikan bukti asli (bukan hasil edit)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal untuk zoom image -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none;">
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title fw-bold">Bukti Transfer (Full Size)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center p-4">
                <img id="modalImage" src="" alt="Bukti Transfer" class="img-fluid" style="border-radius: 15px;">
            </div>
        </div>
    </div>
</div>

<script>
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    var modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}

// Add smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});
</script>

<?= $this->endSection(); ?>