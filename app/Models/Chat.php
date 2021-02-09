<?php

namespace App\Models;

use CodeIgniter\Model;

class Chat extends Model
{
    protected $table = 'chat';
    protected $allowedFields = ['id_user', 'pesan', 'tanggal', 'jam'];
}
