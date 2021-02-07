<?php

namespace App\Models;

use CodeIgniter\Model;

class Absen extends Model
{
    protected $table = 'absen';
    protected $allowedFields = ['id_absen', 'id_user', 'nama', 'angkatan', 'lat', 'long', 'jam', 'tanggal', 'foto'];
}
