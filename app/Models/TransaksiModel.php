<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'jenis', 'jumlah', 'keterangan', 'tanggal', 'created_at'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // Fungsi untuk mengambil semua transaksi dengan join ke tabel users
    public function getLaporanKas($startDate = null, $endDate = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('transaksi.*, users.nama_lengkap');
        $builder->join('users', 'users.id = transaksi.user_id', 'left');
        
        // Filter berdasarkan tanggal jika ada
        if ($startDate && $endDate) {
            $builder->where('transaksi.tanggal >=', $startDate);
            $builder->where('transaksi.tanggal <=', $endDate);
        }
        
        $builder->orderBy('transaksi.tanggal', 'DESC');
        $builder->orderBy('transaksi.id', 'DESC');
        
        return $builder->get()->getResultArray();
    }
    
    // Fungsi untuk menghitung total pemasukan
    public function getTotalMasuk($startDate = null, $endDate = null)
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('jumlah');
        $builder->where('jenis', 'masuk');
        
        if ($startDate && $endDate) {
            $builder->where('tanggal >=', $startDate);
            $builder->where('tanggal <=', $endDate);
        }
        
        $result = $builder->get()->getRow();
        return $result->jumlah ?? 0;
    }
    
    // Fungsi untuk menghitung total pengeluaran
    public function getTotalKeluar($startDate = null, $endDate = null)
    {
        $builder = $this->db->table($this->table);
        $builder->selectSum('jumlah');
        $builder->where('jenis', 'keluar');
        
        if ($startDate && $endDate) {
            $builder->where('tanggal >=', $startDate);
            $builder->where('tanggal <=', $endDate);
        }
        
        $result = $builder->get()->getRow();
        return $result->jumlah ?? 0;
    }
}
