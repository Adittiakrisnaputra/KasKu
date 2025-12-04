<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class LaporanPdf extends BaseController
{
    protected $transaksiModel;
    
    public function __construct()
    {
        $this->transaksiModel = new TransaksiModel();
    }
    
    public function index()
    {
        // Tampilkan halaman form filter tanggal
        return view('laporan/filter_form');
    }
    
    public function generatePdf()
    {
        // Ambil parameter tanggal dari URL (jika ada)
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        
        // Ambil data transaksi
        $data['transaksi'] = $this->transaksiModel->getLaporanKas($startDate, $endDate);
        $data['total_masuk'] = $this->transaksiModel->getTotalMasuk($startDate, $endDate);
        $data['total_keluar'] = $this->transaksiModel->getTotalKeluar($startDate, $endDate);
        $data['saldo'] = $data['total_masuk'] - $data['total_keluar'];
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        
        // Load view untuk PDF
        $html = view('laporan/pdf_template', $data);
        
        // Setup Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        
        $dompdf = new Dompdf($options);
        
        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);
        
        // Setup ukuran dan orientasi kertas
        $dompdf->setPaper('A4', 'portrait');
        
        // Render PDF
        $dompdf->render();
        
        // Nama file PDF
        $filename = 'Laporan_Kas_' . date('Y-m-d_His') . '.pdf';
        
        // Output PDF ke browser (inline = tampil di browser, attachment = download)
        $dompdf->stream($filename, array("Attachment" => false));
    }
    
    public function downloadPdf()
    {
        // Sama seperti generatePdf tapi langsung download
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');
        
        $data['transaksi'] = $this->transaksiModel->getLaporanKas($startDate, $endDate);
        $data['total_masuk'] = $this->transaksiModel->getTotalMasuk($startDate, $endDate);
        $data['total_keluar'] = $this->transaksiModel->getTotalKeluar($startDate, $endDate);
        $data['saldo'] = $data['total_masuk'] - $data['total_keluar'];
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;
        
        $html = view('laporan/pdf_template', $data);
        
        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        
        $filename = 'Laporan_Kas_' . date('Y-m-d_His') . '.pdf';
        
        // Attachment = true berarti langsung download
        $dompdf->stream($filename, array("Attachment" => true));
    }
}