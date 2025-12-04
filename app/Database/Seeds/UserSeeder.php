<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Cek dulu apakah admin sudah ada? Biar tidak dobel saat dijalankan berkali-kali
        $exist = $this->db->table('users')->where('username', 'admin')->get()->getRow();

        if (!$exist) {
            $data = [
                [
                    'username'     => 'admin',
                    // Ganti password ini nanti setelah login pertama kali
                    'password'     => password_hash('admin123', PASSWORD_DEFAULT), 
                    'nama_lengkap' => 'Super Admin KasKu',
                    'role'         => 'admin',
                    'no_hp'        => '08000000000',
                    'status'       => 'aktif',
                    'created_at'   => date('Y-m-d H:i:s'),
                    'updated_at'   => date('Y-m-d H:i:s'),
                ]
            ];

            $this->db->table('users')->insertBatch($data);
        }
    }
}