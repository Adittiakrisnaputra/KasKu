<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Keuangan Kas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #333;
            padding-bottom: 10px;
        }
        
        .header h2 {
            margin: 5px 0;
            font-size: 18px;
        }
        
        .header p {
            margin: 3px 0;
            font-size: 11px;
        }
        
        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        table thead {
            background-color: #f0f0f0;
        }
        
        table th {
            border: 1px solid #333;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .summary {
            margin-top: 20px;
            float: right;
            width: 300px;
        }
        
        .summary table {
            width: 100%;
        }
        
        .summary td {
            padding: 5px;
        }
        
        .summary .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
            border-top: 2px solid #333;
        }
        
        .badge-masuk {
            background-color: #28a745;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        
        .badge-keluar {
            background-color: #dc3545;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 10px;
        }
        
        .footer {
            margin-top: 50px;
            text-align: right;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>
    <!-- Header Laporan -->
    <div class="header">
        <h2>LAPORAN KEUANGAN KAS</h2>
        <p>Sistem Informasi Keuangan</p>
    </div>
    
    <!-- Periode Laporan -->
    <?php if ($start_date && $end_date): ?>
        <div class="periode">
            Periode: <?= date('d/m/Y', strtotime($start_date)) ?> s/d <?= date('d/m/Y', strtotime($end_date)) ?>
        </div>
    <?php else: ?>
        <div class="periode">
            Semua Transaksi
        </div>
    <?php endif; ?>
    
    <!-- Tabel Transaksi -->
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%">User</th>
                <th width="10%" class="text-center">Jenis</th>
                <th width="35%">Keterangan</th>
                <th width="23%" class="text-right">Jumlah (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($transaksi) > 0): ?>
                <?php $no = 1; ?>
                <?php foreach ($transaksi as $row): ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                        <td><?= esc($row['nama_lengkap'] ?? 'N/A') ?></td>
                        <td class="text-center">
                            <span class="badge-<?= $row['jenis'] ?>">
                                <?= strtoupper($row['jenis']) ?>
                            </span>
                        </td>
                        <td><?= esc($row['keterangan']) ?></td>
                        <td class="text-right">
                            <?= number_format($row['jumlah'], 0, ',', '.') ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-data">Tidak ada data transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    <!-- Summary/Ringkasan -->
    <div class="summary">
        <table>
            <tr>
                <td>Total Pemasukan:</td>
                <td class="text-right">Rp <?= number_format($total_masuk, 0, ',', '.') ?></td>
            </tr>
            <tr>
                <td>Total Pengeluaran:</td>
                <td class="text-right">Rp <?= number_format($total_keluar, 0, ',', '.') ?></td>
            </tr>
            <tr class="total-row">
                <td>Saldo:</td>
                <td class="text-right">Rp <?= number_format($saldo, 0, ',', '.') ?></td>
            </tr>
        </table>
    </div>
    
    <div style="clear: both;"></div>
    
    <!-- Footer -->
    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>
    </div>
</body>
</html>