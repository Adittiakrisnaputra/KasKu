<?php

namespace App\Models;

use CodeIgniter\Model;

class PembayaranModel extends Model
{
    protected $table            = 'pembayaran_qris';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id', 
        'nama_pembayar', 
        'nominal', 
        'keterangan', 
        'bukti_transfer',
        'status',
        'catatan_admin',
        'tanggal_bayar',
        'approved_by',
        'approved_at',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nama_pembayar' => 'required|min_length[3]',
        'nominal' => 'required|numeric|greater_than[0]',
        'keterangan' => 'required',
        'tanggal_bayar' => 'required|valid_date'
    ];

    protected $validationMessages = [
        'nama_pembayar' => [
            'required' => 'Nama pembayar harus diisi',
            'min_length' => 'Nama pembayar minimal 3 karakter'
        ],
        'nominal' => [
            'required' => 'Nominal harus diisi',
            'numeric' => 'Nominal harus berupa angka',
            'greater_than' => 'Nominal harus lebih dari 0'
        ],
        'keterangan' => [
            'required' => 'Keterangan harus diisi'
        ]
    ];

    /**
     * Ambil pembayaran dengan join user
     */
    public function getPembayaranWithUser($status = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('pembayaran_qris.*, users.nama_lengkap, users.username');
        $builder->join('users', 'users.id = pembayaran_qris.user_id', 'left');
        
        if ($status) {
            $builder->where('pembayaran_qris.status', $status);
        }
        
        $builder->orderBy('pembayaran_qris.created_at', 'DESC');
        
        return $builder->get()->getResultArray();
    }

    /**
     * Hitung jumlah pembayaran berdasarkan status
     */
    public function countByStatus($status)
    {
        return $this->where('status', $status)->countAllResults();
    }

    /**
     * Ambil pembayaran pending
     */
    public function getPendingPayments()
    {
        return $this->getPembayaranWithUser('pending');
    }

    /**
     * Approve pembayaran
     */
    public function approvePembayaran($id, $adminId, $catatan = null)
    {
        $data = [
            'status' => 'approved',
            'approved_by' => $adminId,
            'approved_at' => date('Y-m-d H:i:s'),
            'catatan_admin' => $catatan
        ];
        
        return $this->update($id, $data);
    }

    /**
     * Reject pembayaran
     */
    public function rejectPembayaran($id, $adminId, $catatan = null)
    {
        $data = [
            'status' => 'rejected',
            'approved_by' => $adminId,
            'approved_at' => date('Y-m-d H:i:s'),
            'catatan_admin' => $catatan
        ];
        
        return $this->update($id, $data);
    }
}