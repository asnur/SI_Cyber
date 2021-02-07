<?php

namespace App\Models;

use CodeIgniter\Model;

class Donasi extends Model
{
    protected $table = 'donasi';
    protected $allowedFields = ['id_pembayaran', 'jenis_pembayaran', 'nama', 'angkatan', 'email', 'no_tlp', 'alamat', 'catatan', 'nominal', 'status'];

    public function jumlah()
    {
        $db = \Config\Database::connect();

        $jumlah = $db->query("SELECT SUM(donasi.nominal) AS jumlah FROM donasi WHERE donasi.status ='settlement'")->getResultArray();

        return $jumlah;
    }
}
