<?php

namespace App\Models;

use CodeIgniter\Model;

class Artikel extends Model
{
    protected $table = 'artikel';
    protected $allowedFields = ['judul', 'foto', 'isi', 'tanggal'];
}
