<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center py-5" style="min-height: 100vh;">
        <div class="col-11 col-md-8 col-lg-5">
            <div class="card modern-card">
                <div class="card-body p-5">
                    <!-- Logo & Title -->
                    <div class="text-center mb-4">
                        <div class="logo-circle mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="white" viewBox="0 0 16 16">
                                <path d="M1 3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1H1zm7 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                                <path d="M0 5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V5zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V7a2 2 0 0 1-2-2H3z"/>
                            </svg>
                        </div>
                        <h3 class="fw-bold mb-2">Daftar Anggota</h3>
                        <p class="text-muted small">Bergabunglah dengan KasKu</p>
                    </div>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                                </svg>
                                <div>
                                    <strong>Gagal!</strong> <?= session()->getFlashdata('error'); ?>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <div class="d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 flex-shrink-0" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                </svg>
                                <div>
                                    <strong>Berhasil!</strong> <?= session()->getFlashdata('success'); ?>
                                </div>
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('auth/registerProcess'); ?>" method="post" id="registerForm">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" class="form-control form-control-modern" name="nama_lengkap" 
                                   placeholder="Nama lengkap Anda" 
                                   value="<?= old('nama_lengkap'); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" class="form-control form-control-modern" name="username" 
                                   placeholder="Username unik (min. 4 karakter)" 
                                   value="<?= old('username'); ?>" 
                                   pattern="[a-zA-Z0-9_]{4,}" 
                                   title="Username minimal 4 karakter, hanya huruf, angka, dan underscore"
                                   required>
                            <small class="text-muted">Minimal 4 karakter, tanpa spasi</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">No. Handphone</label>
                            <input type="tel" class="form-control form-control-modern" name="no_hp" 
                                   placeholder="08xxxxxxxx" 
                                   value="<?= old('no_hp'); ?>" 
                                   pattern="[0-9]{10,13}" 
                                   title="Nomor HP 10-13 digit"
                                   required>
                            <small class="text-muted">Contoh: 08123456789 (10-13 digit)</small>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" class="form-control form-control-modern" name="password" 
                                       id="password" placeholder="******" 
                                       minlength="6" required>
                                <small class="text-muted">Minimal 6 karakter</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Ulangi Password</label>
                                <input type="password" class="form-control form-control-modern" name="password2" 
                                       id="password2" placeholder="******" 
                                       minlength="6" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small id="passwordMatch" class="text-danger"></small>
                        </div>

                        <button type="submit" class="btn btn-modern-primary w-100 py-3 fw-bold mt-2">
                            DAFTAR SEKARANG
                        </button>
                    </form>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <a href="<?= base_url('/') ?>" class="btn btn-modern-outline w-100 py-3">
                            Sudah punya akun? Login disini
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Card Style */
.modern-card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
    background: white;
}

/* Logo Circle */
.logo-circle {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Modern Form Control */
.form-control-modern {
    padding: 12px 16px;
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

.form-control-modern::placeholder {
    color: #9ca3af;
}

/* Modern Primary Button */
.btn-modern-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 8px;
    color: white;
    font-size: 15px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-modern-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(102, 126, 234, 0.3);
    background: linear-gradient(135deg, #5568d3 0%, #6a4190 100%);
}

/* Modern Outline Button */
.btn-modern-outline {
    background: transparent;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    color: #374151;
    font-size: 14px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.btn-modern-outline:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #374151;
}

/* Form Label */
.form-label {
    color: #374151;
    font-size: 14px;
    margin-bottom: 8px;
}

/* Alert Styles */
.alert {
    border-radius: 8px;
    border: none;
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Small Text */
small.text-muted {
    font-size: 12px;
}

/* Responsive */
@media (max-width: 576px) {
    .modern-card .card-body {
        padding: 2rem 1.5rem !important;
    }
}
</style>

<script>
// Validasi password match di client-side
document.getElementById('password2').addEventListener('keyup', function() {
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;
    const matchText = document.getElementById('passwordMatch');
    
    if (password !== password2 && password2 !== '') {
        matchText.textContent = '❌ Password tidak sama!';
        matchText.classList.add('text-danger');
        matchText.classList.remove('text-success');
    } else if (password === password2 && password2 !== '') {
        matchText.textContent = '✓ Password cocok';
        matchText.classList.add('text-success');
        matchText.classList.remove('text-danger');
    } else {
        matchText.textContent = '';
    }
});

// Validasi nomor HP
document.querySelector('input[name="no_hp"]').addEventListener('input', function(e) {
    this.value = this.value.replace(/[^0-9]/g, '');
});

// Auto hide alert setelah 5 detik
document.addEventListener('DOMContentLoaded', function() {
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