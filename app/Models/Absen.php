<?php

namespace App\Models;

use CodeIgniter\Model;

class Absen extends Model
{
    protected $table = 'absen';
    protected $allowedFields = ['id_absen', 'id_user', 'nama', 'angkatan', 'lat', 'long', 'jam', 'tanggal', 'foto'];

    public function tanggal($from = '', $to = '')
    {
        $db = \Config\Database::connect();
        $result = $db->query("SELECT * FROM absen WHERE tanggal BETWEEN '$from' AND '$to' ORDER BY tanggal ASC")->getResultArray();

        return $result;
    }
}
