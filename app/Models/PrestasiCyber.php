<?php

namespace App\Models;

use CodeIgniter\Model;

class PrestasiCyber extends Model
{
    protected $table = 'prestasi';
    protected $allowedFields = ['nama', 'angkatan', 'jenis_prestasi', 'tahun', 'tempat'];

    public function tahun_2015()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['tahun' => '2015'])->countAllResults();

        return $prestasi;
    }
    public function tahun_2016()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['tahun' => '2016'])->countAllResults();

        return $prestasi;
    }
    public function tahun_2017()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['tahun' => '2017'])->countAllResults();

        return $prestasi;
    }
    public function tahun_2018()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['tahun' => '2018'])->countAllResults();

        return $prestasi;
    }
    public function tahun_2019()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['tahun' => '2019'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_05()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 05'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_06()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 06'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_07()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 07'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_08()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 08'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_09()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 09'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_10()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 10'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_11()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 11'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_12()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 12'])->countAllResults();

        return $prestasi;
    }

    public function Cyber_13()
    {
        $db = \Config\Database::connect();

        $prestasi = $this->db->table('prestasi')->where(['angkatan' => 'Cyber 13'])->countAllResults();

        return $prestasi;
    }
}
