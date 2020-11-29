<?php

namespace App\Models;

use CodeIgniter\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $allowedFields = ['title', 'start_event', 'end_event'];

    public function load()
    {
        $db = \Config\Database::connect();
        $result = $this->db->table('agenda')->orderBy('id')->get()->getResultArray();

        return $result;
    }
}
