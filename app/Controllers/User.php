<?php

namespace App\Controllers;

use \App\Models\Artikel;

use \App\Models\PrestasiCyber;

use \App\Models\AnggotaCyber;

use \App\Models\Komentar;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

class User extends BaseController
{
    protected $email;
    protected $artikel;
    protected $prestasi;
    protected $anggota;
    protected $komentar;

    public function __construct()
    {
        $this->anggota = new AnggotaCyber();
        $this->email = \Config\Services::email();
        $this->artikel = new Artikel();
        $this->prestasi = new PrestasiCyber();
        $this->komentar = new Komentar();
    }

    public function index()
    {
        $data = [
            'prestasi' => $this->prestasi,
            'anggota' => $this->anggota,
            'artikel' => $this->artikel->paginate(4, 'artikel'),
            'pager' => $this->artikel->pager
        ];

        return view('pages/user/index', $data);
    }

    public function anggota()
    {
        $data = [
            'anggota' => $this->anggota->anggota()
        ];

        return view('pages/user/anggota', $data);
    }

    public function pendaftaran()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('pages/user/pendaftaran', $data);
    }

    public function save_pendaftaran()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[anggota_new.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada / terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama' => [
                'rules' => 'required|is_unique[anggota_new.nama]',
                'error' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada / terdaftar'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'no_tlp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'no hp tidak boleh kosong'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Melebihi 1MB',
                    'is_image' => 'File yang anda masukan bukan Gambar',
                    'mime_in' => 'File yang anda masukan bukan Gambar'
                ]
            ]
        ])) {
            return redirect()->to('/user/pendaftaran')->withInput();
        }
        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = '';
        } else {
            $namaFoto = $fileFoto->getName();
            $fileFoto->move('/dist/img/');
        }
        function generateRandomCode($length = 5)
        {
            $characters = '123456789';
            $charactersLength = strlen($characters);
            $randomNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumber .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomNumber;
        }
        $nama = $this->request->getVar('nama');
        $code = generateRandomCode();
        $to                 = $this->request->getVar('email');
        $subject            = 'Verifikasi Pendaftaran';
        $message            = "<p>Hai $nama untuk mendaftar sebagai member website Cyber Creative anda harus memasuka kode verifikasi dibawah ini</p><br><h3 center>$code</h3><br><p>Apabila gagal dalam melakukan verifikasi silahkah hubungi admin</p>";

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.googlemail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cybercreative9208@gmail.com';
        $mail->Password   = 'cyber9208';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom('cybercreative9208@gmail.com', 'Cyber Creative');
        $mail->addAddress($to);
        $mail->addReplyTo('cybercreative9208@gmail.com', 'Cyber Creative');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $this->anggota->save([
                'nama' => htmlspecialchars($this->request->getVar('nama')),
                'username' => htmlspecialchars($this->request->getVar('username')),
                'email' => htmlspecialchars($this->request->getVar('email')),
                'password' => md5(htmlspecialchars($this->request->getVar('password'))),
                'alamat' => htmlspecialchars($this->request->getVar('alamat')),
                'no_tlp' => htmlspecialchars($this->request->getVar('no_tlp')),
                'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
                'angkatan' => 'Cyber 14',
                'jabatan' => NULL,
                'status' => htmlspecialchars($this->request->getVar('status')),
                'foto' => $namaFoto,
                'code' => $code
            ]);
            session()->setFlashdata('pesan', 'Pendaftaran Berhasil, Silahkan Cek Email untuk Verifikasi');
            return redirect()->to('/login/verifikasi/' . $this->request->getVar('username'));
        } else {
            session()->setFlashdata('pesan', 'Pendaftaran Gagal');
            return redirect()->to('/user/pendaftaran');
        }
    }

    public function profil()
    {
        if (!isset($_SESSION['user'])) {
            session()->setFlashdata('pesan', 'Anda Harus Login');
            return redirect()->to('/login/index');
        } else {
            $id = $_SESSION['user'][0]['id'];
            $data = [
                'profil' => $this->anggota->where(['id' => $id])->first(),
                'validation' => \Config\Services::validation()
            ];
            return view('pages/user/profil', $data);
        }
    }

    public function ubah_data($id)
    {
        $data_anggota = $this->anggota->where(['id' => $id])->first();
        $usernameLama = $data_anggota['username'];
        $usernameBaru = htmlspecialchars($this->request->getVar('username'));
        if ($usernameBaru == $usernameLama) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[anggota_new.username]';
        }
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'username' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada / terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'no_tlp' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'no hp tidak boleh kosong'
                ]
            ],
            'foto' => [
                'rules' => 'max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran Melebihi 1MB',
                    'is_image' => 'File yang anda masukan bukan Gambar',
                    'mime_in' => 'File yang anda masukan bukan Gambar'
                ]
            ]
        ])) {
            return redirect()->to('/user/profil')->withInput();
        }

        $fileFoto = $this->request->getFile('foto');

        if ($fileFoto->getError() == 4) {
            $namaFoto = $data_anggota['foto'];
        } else {
            $namaFoto = $fileFoto->getName();
            $fileFoto->move('/dist/img/');
        }

        $this->anggota->save([
            'id' => $id,
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'alamat' => htmlspecialchars($this->request->getVar('alamat')),
            'no_tlp' => htmlspecialchars($this->request->getVar('no_tlp')),
            'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
            'angkatan' => htmlspecialchars($this->request->getVar('angkatan')),
            'foto' => $namaFoto
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diUbah');
        return redirect()->to('/user/profil');
    }

    public function artikel($id)
    {
        $data = [
            'artikel' => $this->artikel->where(['id' => $id])->first(),
            'artikel_rekomendasi' => $this->artikel->limit(10)->orderBy('id', 'DESC')->find(),
            'komentar' => $this->komentar->join('anggota_new', 'komentar.id_user = anggota_new.id')->where(['id_artikel' => $id])->findALl()
        ];

        return view('pages/user/artikel', $data);
    }

    public function komentar($id)
    {
        if (!isset($_SESSION['user'])) {
            session()->setFlashdata('pesan', 'Mengirim Komentar Gagal Anda Harus Login Terlebih dahulu');
            return redirect()->to('/user/artikel/' . $id);
        } else {
            $this->komentar->save([
                'id_artikel' => $id,
                'id_user' => $_SESSION['user'][0]['id'],
                'isi_komentar' => htmlspecialchars($this->request->getVar('komentar')),
                'tanggal' => date('Y-m-d')
            ]);

            session()->setFlashdata('pesan', 'Komentar Berhasil diTambahkan');
            return redirect()->to('/user/artikel/' . $id);
        }
    }

    // public function email()
    // {
    //     $this->email->setFrom('cybercreative9208@gmail.com', 'Cyber Creative');
    //     $this->email->setTo('asnurramdhani12@gmail.com');
    //     $this->email->setSubject('Test');
    //     $this->email->setMessage('<h1>Test Email</h1>');

    //     if (!$this->email->send()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
