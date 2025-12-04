<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ============================================
// PUBLIC ROUTES (Tidak perlu login)
// ============================================
$routes->get('/', 'Auth::index'); 
$routes->get('/register', 'Auth::register');

// Auth Process Routes
$routes->post('/auth/loginProcess', 'Auth::loginProcess');
$routes->post('/auth/registerProcess', 'Auth::registerProcess');

// Support juga route lama (backward compatibility)
$routes->post('/register/save', 'Auth::registerProcess');
// Logout - HARUS LOGIN dulu baru bisa logout
$routes->get('/logout', 'Auth::logout', ['filter' => 'auth']);
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']);


// ============================================
// PROTECTED ROUTES (Harus login dulu)
// ============================================

// Dashboard - HARUS LOGIN
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

// Manajemen Anggota - HARUS LOGIN
$routes->post('/anggota/save', 'Anggota::save', ['filter' => 'auth']);
$routes->post('/anggota/update', 'Anggota::update', ['filter' => 'auth']);
$routes->get('/anggota/delete/(:num)', 'Anggota::delete/$1', ['filter' => 'auth']);

// Manajemen Transaksi - HARUS LOGIN
$routes->post('/transaksi/save', 'Transaksi::save', ['filter' => 'auth']);
$routes->post('/transaksi/update', 'Transaksi::update', ['filter' => 'auth']);
$routes->get('/transaksi/delete/(:num)', 'Transaksi::delete/$1', ['filter' => 'auth']);

// cetak pdf - HARUS LOGIN
$routes->get('laporanpdf', 'LaporanPdf::index', ['filter' => 'auth']);
$routes->get('laporanpdf/generatePdf', 'LaporanPdf::generatePdf', ['filter' => 'auth']);
$routes->get('laporanpdf/downloadPdf', 'LaporanPdf::downloadPdf', ['filter' => 'auth']);

// Notifikasi - HARUS LOGIN
$routes->post('/notifikasi/kirim', 'Notifikasi::kirim');
$routes->get('/notifikasi/baca/(:num)', 'Notifikasi::baca/$1');
$routes->get('/notifikasi/bacaSemua', 'Notifikasi::bacaSemua');
// HAPUS NOTIFIKASI - DI USER
$routes->get('/notifikasi/hapus/(:num)', 'Notifikasi::hapus/$1');


// ============================================
// UPLOAD PEMBAYARAN
// ============================================

// Upload bukti (user/anggota)
$routes->get('qris/upload', 'UploadPembayaran::uploadBukti', ['filter' => 'auth']);
$routes->post('qris/prosesUploadBukti', 'UploadPembayaran::prosesUploadBukti', ['filter' => 'auth']);
$routes->get('qris/riwayat', 'UploadPembayaran::riwayat', ['filter' => 'auth']);

// ============================================
// KELOLA PEMBAYARAN (ADMIN ONLY)
// ============================================
$routes->get('pembayaran', 'PembayaranValidasi::index', ['filter' => 'auth']);
$routes->get('pembayaran/detail/(:num)', 'PembayaranValidasi::detail/$1', ['filter' => 'auth']);
$routes->post('pembayaran/approve/(:num)', 'PembayaranValidasi::approve/$1', ['filter' => 'auth']);
$routes->post('pembayaran/reject/(:num)', 'PembayaranValidasi::reject/$1', ['filter' => 'auth']);
$routes->get('pembayaran/viewBukti/(:any)', 'PembayaranValidasi::viewBukti/$1', ['filter' => 'auth']);