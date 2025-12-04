<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
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
                        <h3 class="fw-bold mb-2">Kas Ku</h3>
                        <p class="text-muted small">Sistem Manajemen Keuangan Online</p>
                    </div>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ✅ <?= session()->getFlashdata('success'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ❌ <strong>Gagal!</strong> <?= session()->getFlashdata('error'); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form action="<?= base_url('auth/loginProcess') ?>" method="post">
                        <?= csrf_field(); ?>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label fw-semibold">Username</label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                    </svg>
                                </span>
                                <input type="text" name="username" class="form-control form-control-modern" 
                                       id="username" placeholder="Masukkan username" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <div class="input-group-modern">
                                <span class="input-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                                    </svg>
                                </span>
                                <input type="password" name="password" class="form-control form-control-modern" 
                                       id="password" placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-modern-primary w-100 py-3 fw-bold">
                            Login
                        </button>
                    </form>

                    <!-- Register Link -->
                    <div class="text-center mt-4">
                        <a href="<?= base_url('register') ?>" class="btn btn-modern-outline w-100 py-3">
                            Belum punya akun? Daftar disini
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

/* Modern Input Group */
.input-group-modern {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
    z-index: 10;
    pointer-events: none;
}

.form-control-modern {
    padding: 12px 16px 12px 48px;
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

/* Alert Animations */
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

/* Responsive */
@media (max-width: 576px) {
    .modern-card .card-body {
        padding: 2rem 1.5rem !important;
    }
}
</style>

<script>
// Auto hide alerts after 5 seconds
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