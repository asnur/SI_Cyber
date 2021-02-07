<?php

namespace App\Database\Seeds;

class artikel extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 1; $i <= 9; $i++) {
            $id_user = $faker->randomNumber;
            $nama = $faker->name;
            $angkatan = "Cyber 12";
            $lat = -7.090910999999999;
            $long = 107.668887;
            $jam = $faker->dateTimeThisCentury->format('H:i:s');
            $tanggal = "2021-02-05";
            $data = [
                'nama' => $nama,
                'angkatan'    => $angkatan,
                'lat'    => $lat,
                'long'    => $long,
                'jam'    => $jam,
                'tanggal' => $tanggal
            ];
            $this->db->table('absen')->insert($data);
        }

        // $this->db->query(
        //     "INSERT INTO artikel (username, email) VALUES(:username:, :email:)",
        //     $data
        // );


    }
}
