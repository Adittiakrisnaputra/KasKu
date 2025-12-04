<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-5">
    <div class="alert alert-success">
        <h4 class="alert-heading">Login Berhasil! 🎉</h4>
        <p>Selamat datang, <strong><?= $nama; ?></strong>.</p>
        <hr>
        <p class="mb-0">Anda login sebagai: <span class="badge bg-primary"><?= $role; ?></span></p>
    </div>
    
    <a href="<?= base_url('logout') ?>" class="btn btn-danger">Logout</a>
</div>
<?= $this->endSection(); ?>