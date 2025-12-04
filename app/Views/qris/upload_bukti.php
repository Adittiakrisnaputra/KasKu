<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<style>
.gradient-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-modern {
    border-radius: 24px;
    border: none;
    overflow: hidden;
}

.form-modern {
    position: relative;
}

.form-modern .form-label {
    font-weight: 600;
    color: #374151;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-modern .form-control,
.form-modern .form-select {
    border-radius: 12px;
    border: 2px solid #e5e7eb;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.form-modern .form-control:focus,
.form-modern .form-select:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.upload-zone {
    border: 3px dashed #d1d5db;
    border-radius: 16px;
    padding: 40px 20px;
    text-align: center;
    transition: all 0.3s ease;
    cursor: pointer;
    background: #f9fafb;
}

.upload-zone:hover {
    border-color: #667eea;
    background: #f0f4ff;
}

.upload-zone.dragover {
    border-color: #667eea;
    background: #e0e7ff;
    transform: scale(1.02);
}

.preview-container {
    border-radius: 16px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.preview-container img {
    width: 100%;
    height: auto;
    display: block;
}

.remove-preview {
    position: absolute;
    top: 12px;
    right: 12px;
    background: rgba(239, 68, 68, 0.9);
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.remove-preview:hover {
    background: rgb(220, 38, 38);
    transform: scale(1.1);
}

.qr-container {
    background: white;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.15);
    margin-bottom: 32px;
}

.qr-container img {
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.instruction-card {
    background: linear-gradient(135deg, #e0e7ff 0%, #f0f4ff 100%);
    border-radius: 16px;
    padding: 24px;
    border: none;
    margin-bottom: 24px;
}

.instruction-card ol {
    margin: 0;
    padding-left: 20px;
}

.instruction-card ol li {
    margin-bottom: 8px;
    color: #4b5563;
}

.btn-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 14px 28px;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    font-size: 1.05rem;
}

.btn-gradient:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    color: white;
}

.navbar-modern {
    background: white !important;
    box-shadow: 0 2px 20px rgba(0,0,0,0.08);
    padding: 1rem 0;
}

.alert-modern {
    border-radius: 12px;
    border: none;
    padding: 16px 20px;
}

.input-group-text {
    border-radius: 12px 0 0 12px;
    border: 2px solid #e5e7eb;
    border-right: none;
    background: #f9fafb;
    font-weight: 600;
}

.step-indicator {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.step-number {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
}

.warning-card {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-radius: 12px;
    padding: 16px 20px;
    border: none;
    margin-top: 20px;
}

@media (max-width: 768px) {
    .qr-container {
        padding: 16px;
    }
    
    .upload-zone {
        padding: 30px 15px;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-modern mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <span style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-size: 1.3rem;">
                💳 Upload Bukti Pembayaran
            </span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= base_url('dashboard') ?>" class="btn btn-outline-secondary btn-sm rounded-pill">
                ← Dashboard
            </a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <?php if (session()->getFlashdata('pesan')): ?>
                <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <span style="font-size: 1.5rem; margin-right: 12px;">✅</span>
                        <span><?= session()->getFlashdata('pesan') ?></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-modern alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <span style="font-size: 1.5rem; margin-right: 12px;">❌</span>
                        <span><?= session()->getFlashdata('error') ?></span>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger alert-modern">
                    <div class="d-flex align-items-start">
                        <span style="font-size: 1.5rem; margin-right: 12px;">⚠️</span>
                        <div>
                            <strong>Error:</strong>
                            <ul class="mb-0 mt-2">
                                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Instruction Card -->
            <div class="instruction-card">
                <div class="d-flex align-items-center mb-3">
                    <span style="font-size: 1.5rem; margin-right: 12px;">📝</span>
                    <h6 class="mb-0 fw-bold" style="color: #4338ca;">Panduan Upload Bukti Pembayaran</h6>
                </div>
                <ol>
                    <li>Scan QR Code yang tersedia di bawah ini</li>
                    <li>Lakukan pembayaran melalui e-wallet</li>
                    <li>Screenshot bukti transfer yang berhasil</li>
                    <li>Isi form lengkap dan upload screenshot</li>
                    <li>Tunggu konfirmasi dari admin (1x24 jam)</li>
                </ol>
            </div>

            <!-- QR Code Section -->
            <div class="qr-container text-center">
                <h6 class="fw-bold mb-3" style="color: #374151;">
                    <span style="font-size: 1.3rem;">📱</span> Scan QR Code untuk Pembayaran
                </h6>
                <img src="<?= base_url('uploads/qr_admin.jpg') ?>" 
                     alt="QR Pembayaran" 
                     class="img-fluid" 
                     style="max-width: 280px;">
                <p class="mt-3 mb-0 text-muted">
                    <small>Pastikan nominal yang dibayar sesuai dengan yang diinput</small>
                </p>
            </div>

            <!-- Main Form Card -->
            <div class="card card-modern shadow-lg">
                <div class="card-header gradient-bg text-white py-4">
                    <h5 class="mb-0 fw-bold">
                        <span style="font-size: 1.3rem;">📸</span> Form Upload Bukti Transfer
                    </h5>
                </div>
                <div class="card-body p-4">
                    
                    <form action="<?= base_url('qris/prosesUploadBukti') ?>" method="post" enctype="multipart/form-data" class="form-modern">
                        <?= csrf_field(); ?>

                        <!-- Step 1 -->
                        <div class="step-indicator">
                            <div class="step-number">1</div>
                            <span class="fw-bold" style="color: #374151;">Data Pembayar</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                👤 Nama Pembayar <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_pembayar" 
                                   class="form-control" 
                                   value="<?= esc($nama) ?>"
                                   placeholder="Masukkan nama Anda"
                                   required>
                            <small class="text-muted">Nama yang melakukan pembayaran</small>
                        </div>

                        <!-- Step 2 -->
                        <div class="step-indicator mt-4">
                            <div class="step-number">2</div>
                            <span class="fw-bold" style="color: #374151;">Detail Transaksi</span>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    💰 Nominal Pembayaran <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" 
                                           name="nominal" 
                                           class="form-control" 
                                           placeholder="50000" 
                                           min="1000"
                                           style="border-left: none; border-radius: 0 12px 12px 0;"
                                           required>
                                </div>
                                <small class="text-muted">Min. Rp 1.000</small>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label">
                                    📅 Tanggal Pembayaran <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       name="tanggal_bayar" 
                                       class="form-control" 
                                       value="<?= date('Y-m-d') ?>"
                                       required>
                                <small class="text-muted">Tanggal melakukan transfer</small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                📝 Keterangan <span class="text-danger">*</span>
                            </label>
                            <textarea name="keterangan" 
                                      class="form-control" 
                                      rows="3" 
                                      placeholder="Contoh: Iuran Kas Bulan Desember 2025"
                                      required></textarea>
                        </div>

                        <!-- Step 3 -->
                        <div class="step-indicator mt-4">
                            <div class="step-number">3</div>
                            <span class="fw-bold" style="color: #374151;">Upload Bukti Transfer</span>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">
                                📷 Screenshot Bukti Transfer <span class="text-danger">*</span>
                            </label>
                            
                            <div class="upload-zone" id="uploadZone">
                                <input type="file" 
                                       name="bukti_transfer" 
                                       class="d-none" 
                                       accept="image/*"
                                       id="fileBukti"
                                       required>
                                <div id="uploadPrompt">
                                    <div style="font-size: 3rem; margin-bottom: 12px;">📤</div>
                                    <h6 class="fw-bold mb-2">Klik atau Drop File di Sini</h6>
                                    <p class="text-muted small mb-2">Drag & drop file atau klik untuk memilih</p>
                                    <small class="text-muted">Format: JPG, PNG, JPEG • Max: 2MB</small>
                                </div>
                            </div>
                            
                            <!-- Preview Image -->
                            <div id="imagePreview" class="mt-3" style="display: none;">
                                <p class="small fw-bold mb-2" style="color: #374151;">Preview Bukti Transfer:</p>
                                <div class="preview-container">
                                    <img id="previewImg" src="" alt="Preview">
                                    <button type="button" class="remove-preview" id="removePreview">
                                        ✕
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="warning-card">
                            <div class="d-flex align-items-start">
                                <span style="font-size: 1.3rem; margin-right: 12px;">⚠️</span>
                                <div>
                                    <strong style="color: #92400e;">Perhatian:</strong>
                                    <p class="mb-0 small mt-1" style="color: #78350f;">
                                        Pastikan foto bukti transfer <strong>jelas dan terbaca</strong>. 
                                        Screenshot harus menampilkan nominal, tanggal, dan status berhasil. 
                                        Admin akan verifikasi dalam 1x24 jam.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-gradient btn-lg">
                                <span style="font-size: 1.2rem; margin-right: 8px;">📤</span>
                                Upload Bukti Pembayaran
                            </button>
                            <a href="<?= base_url('qris/riwayat') ?>" class="btn btn-outline-secondary btn-lg" style="border-radius: 12px;">
                                📋 Lihat Riwayat Pembayaran
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Upload Zone Interaction
const uploadZone = document.getElementById('uploadZone');
const fileInput = document.getElementById('fileBukti');
const imagePreview = document.getElementById('imagePreview');
const previewImg = document.getElementById('previewImg');
const uploadPrompt = document.getElementById('uploadPrompt');
const removePreview = document.getElementById('removePreview');

// Click to upload
uploadZone.addEventListener('click', () => {
    fileInput.click();
});

// Drag and drop
uploadZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadZone.classList.add('dragover');
});

uploadZone.addEventListener('dragleave', () => {
    uploadZone.classList.remove('dragover');
});

uploadZone.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadZone.classList.remove('dragover');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        handleFileSelect(files[0]);
    }
});

// File input change
fileInput.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        handleFileSelect(file);
    }
});

// Handle file selection
function handleFileSelect(file) {
    // Validate file size (2MB)
    if (file.size > 2 * 1024 * 1024) {
        alert('❌ Ukuran file terlalu besar! Maksimal 2MB');
        fileInput.value = '';
        return;
    }
    
    // Validate file type
    if (!file.type.startsWith('image/')) {
        alert('❌ File harus berupa gambar (JPG, PNG, JPEG)');
        fileInput.value = '';
        return;
    }
    
    // Show preview
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImg.src = e.target.result;
        imagePreview.style.display = 'block';
        uploadZone.style.display = 'none';
    }
    reader.readAsDataURL(file);
}

// Remove preview
removePreview.addEventListener('click', (e) => {
    e.stopPropagation();
    fileInput.value = '';
    imagePreview.style.display = 'none';
    uploadZone.style.display = 'block';
});

// Prevent form submission on enter in text fields
document.querySelectorAll('input[type="text"], input[type="number"]').forEach(input => {
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
        }
    });
});
</script>

<?= $this->endSection(); ?>