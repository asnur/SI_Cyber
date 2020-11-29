<?php

namespace App\Models;

use CodeIgniter\Database\Config;
use CodeIgniter\Model;


class AnggotaCyber extends Model
{
    protected $table = 'anggota_new';
    protected $useTimestamps = true;
    protected $allowedFields = ['id', 'nama', 'username', 'email', 'password', 'jenis_kelamin', 'alamat', 'no_tlp',  'angkatan', 'jabatan', 'status', 'foto', 'izin', 'code'];

    public function anggota()
    {
        $db = \Config\Database::connect();
        $anggota = $this->db->query("SELECT * FROM anggota_new WHERE status = 'Aktif' OR status = 'Alumni'")->getResultArray();

        return $anggota;
    }
}
