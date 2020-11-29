<?php

namespace App\Models;

use CodeIgniter\Database\Config;
use CodeIgniter\Model;


class AnggotaCyber extends Model
{
    protected $table = 'anggota_new';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama', 'username', 'email', 'password', 'jenis_kelamin', 'alamat', 'no_tlp',  'angkatan', 'jabatan', 'status', 'foto', 'izin', 'code'];
}
