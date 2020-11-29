<?php

namespace App\Models;

use CodeIgniter\Model;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $allowedFields = ['id_artikel', 'id_user', 'isi_komentar', 'tanggal'];
}
