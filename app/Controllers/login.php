<?php

namespace App\Controllers;

use App\Models\AnggotaCyber;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

class Login extends BaseController
{
    protected $anggota;

    public function __construct()
    {
        $this->anggota = new AnggotaCyber();
    }

    public function index()
    {
        return view('pages/login/index');
    }

    public function cek_login()
    {
        $user = htmlspecialchars($this->request->getVar('user'));
        $pass = md5(htmlspecialchars($this->request->getVar('pass')));
        $cek_baris = $this->anggota->where(['username' => $user, 'password' => $pass, 'izin' => 1])->countAllResults();
        $cek_data = $this->anggota->where(['username' => $user, 'password' => $pass])->find();
        if ($cek_baris) {
            if ($cek_data[0]['level'] == 'admin') {
                $_SESSION['admin'] = $cek_data;
                session()->setFlashdata('pesan', 'Anda Berhasil Login');
                return redirect()->to('/admin/index');
            } else {
                $_SESSION['user'] = $cek_data;
                session()->setFlashdata('pesan', 'Anda Berhasil Login');
                return redirect()->to('/user/index');
            }
        } else {
            session()->setFlashdata('pesan', 'Anda Gagal Login');
            return redirect()->to('/login/index');
        }
    }

    public function daftar_member()
    {
        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('pages/login/daftar', $data);
    }

    public function save_daftar_member()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|is_unique[anggota_new.username]'
            ],
            'email' => [
                'rules' => 'required|is_unique[anggota_new.email]'
            ]
        ])) {
            session()->setFlashdata('pesan', 'Pendaftaran Gagal Mungkin Username atau Email Sudah dipakai');
            return redirect()->to('/login/daftar_member')->withInput();
        }
        function generateRandomNumber($length = 5)
        {
            $characters = '123456789';
            $charactersLength = strlen($characters);
            $randomNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumber .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomNumber;
        }
        $nama = htmlspecialchars($this->request->getVar('nama'));
        $jk = htmlspecialchars($this->request->getVar('jenis_kelamin'));
        $username = htmlspecialchars($this->request->getVar('username'));
        $password = md5(htmlspecialchars($this->request->getVar('password')));
        $angkatan = htmlspecialchars($this->request->getVar('angkatan'));
        $email = htmlspecialchars($this->request->getVar('email'));
        $code = generateRandomNumber();
        $izin = 0;

        $to                 = $email;
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
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $this->anggota->save([
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'nama' => $nama,
                'jenis_kelamin' => $jk,
                'angkatan' => $angkatan,
                'izin' => $izin,
                'code' => $code
            ]);
            session()->setFlashdata('pesan', 'Pendaftaran Berhasil, Silahkan Cek Email untuk Verifikasi');
            return redirect()->to('/login/verifikasi/' . $username);
        } else {
            session()->setFlashdata('pesan', 'Pendaftaran Gagal');
            return redirect()->to('/login/daftar_member');
        }
    }

    public function verifikasi($username)
    {
        $cek_kode = $this->anggota->where(['username' => $username])->find();
        $data = [
            'kode' => $cek_kode
        ];

        return view('pages/login/verifikasi', $data);
    }

    public function update_verifikasi()
    {
        $id = htmlspecialchars($this->request->getVar('id'));
        $username = htmlspecialchars($this->request->getVar('username'));
        $kode = htmlspecialchars($this->request->getVar('kode'));
        $query = $this->anggota->where(['id' => $id])->first();
        $kode_asli = $query['code'];
        if (empty($kode)) {
            return view('pages/login/index');
        } else {
            if ($kode == $kode_asli) {
                $this->anggota->save([
                    'id' => $id,
                    'izin' => 1
                ]);
                session()->setFlashdata('pesan', 'Verifikasi Berhasil');
                return redirect()->to('/login/index');
            } else {
                session()->setFlashdata('pesan', 'Verifikasi Gagal, Kode yang Anda Masukan Salah');
                return redirect()->to('/login/verifikasi/' . $username);
            }
        }
    }

    public function kirim_ulang($id = '', $username = '', $email = '')
    {
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
        $code = generateRandomCode();

        $to                 = $email;
        $subject            = 'Kirim Ulang Verifikasi Pendaftaran';
        $message            = "<p>Hai $username untuk mendaftar sebagai member website Cyber Creative anda harus memasuka kode verifikasi dibawah ini</p><br><h3 center>$code</h3><br><p>Apabila gagal dalam melakukan verifikasi silahkah hubungi admin</p>";

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
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $this->anggota->save([
                'id' => $id,
                'code' => $code
            ]);
            session()->setFlashdata('pesan', 'Mengirim Ulang Berhasil, Silahkan cek kembali email anda');
            return redirect()->to('/login/verifikasi/' . $username);
        } else {
            session()->setFlashdata('pesan', 'Mengirim Ulang Gagal');
            return redirect()->to('/login/verifikasi/' . $username);
        }
    }

    public function lupa_password()
    {
        return view('pages/login/lupa');
    }

    public function cari_email()
    {
        function generateCodeNumber($length = 5)
        {
            $characters = '123456789';
            $charactersLength = strlen($characters);
            $randomNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumber .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomNumber;
        }
        $email_user = htmlspecialchars($this->request->getVar('email'));

        $cek_baris = $this->anggota->where(['email' => $email_user])->countAllResults();

        if ($cek_baris) {
            $email_asli = $this->anggota->where(['email' => $email_user])->first();
            $nama = $email_asli['nama'];
            $id = $email_asli['id'];
            $username = $email_asli['username'];
            $code = generateCodeNumber();
            $to                 = $email_user;
            $subject            = 'Reset Password';
            $message            = "<p>Haloo $nama<br><br>untuk mereset password anda harus memsukan kode verifikasi,dan dibawah ini adalah data akun anda<br><ul><li>Nama : $nama</li><li>Username : $username</li><li>Kode Verfikasi : $code</li></ul><br>Apabila verifikasi gagal silahkan hubungi admin untuk proses lebih lanjut <br><br> Terima Kasih </p>";

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
            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;
            if ($mail->send()) {
                $this->anggota->save([
                    'id' => $id,
                    'code' => $code
                ]);
                session()->setFlashdata('pesan', 'Email Berhasil ditemukan, silahkan cek email anda untuk melihat kode verifikasi');
                return redirect()->to('verifikasi_lupa_password/' . $username);
            }
        } else {
            session()->setFlashdata('pesan', 'Email Tidak ditemukan');
            return redirect()->to('lupa_password');
        }
    }

    public function verifikasi_lupa_password($username = '')
    {
        $cek_data = $this->anggota->where(['username' => $username])->find();
        $data = [
            'kode' => $cek_data
        ];

        return view('pages/login/verifikasi_lupa', $data);
    }

    public function proses_verifikasi_lupa()
    {
        $username = $this->request->getVar('username');
        $code = $this->request->getVar('kode');
        $cek_data = $this->anggota->where(['username' => $username])->first();
        $code_asli = $cek_data['code'];
        $data = [
            'data' => $cek_data
        ];
        if ($code == $code_asli) {
            session()->setFlashdata('pesan', 'Kode Yang Anda Masukan Benar, Silahkan Ubah Passowrd');
            return view('pages/login/ubah_password', $data);
        } else {
            session()->setFlashdata('pesan', 'Kode Yang Anda Masukan Salah');
            return redirect()->to('verifikasi_lupa_password/' . $username);
        }
    }

    public function ubah_password($id)
    {
        $password = md5($this->request->getVar('password'));
        $this->anggota->save([
            'id' => $id,
            'password' => $password
        ]);
        session()->setFlashdata('pesan', 'Password Berhasil di Ubah');
        return redirect()->to('/login/index');
    }

    public function kirim_ulang_verifikasi($id = '', $username = '', $email = '')
    {
        function generateCode($length = 5)
        {
            $characters = '123456789';
            $charactersLength = strlen($characters);
            $randomNumber = '';
            for ($i = 0; $i < $length; $i++) {
                $randomNumber .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomNumber;
        }
        $code = generateCode();
        $query = $this->anggota->where(['id' => $id])->first();
        $nama = $query['nama'];

        $to                 = $email;
        $subject            = 'Reset Password';
        $message            = "<p>Haloo $nama<br><br>untuk mereset password anda harus memsukan kode verifikasi,dan dibawah ini adalah data akun anda<br><ul><li>Nama : $nama</li><li>Username : $username</li><li>Kode Verfikasi : $code</li></ul><br>Apabila verifikasi gagal silahkan hubungi admin untuk proses lebih lanjut <br><br> Terima Kasih </p>";

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
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        if ($mail->send()) {
            $this->anggota->save([
                'id' => $id,
                'code' => $code
            ]);
            session()->setFlashdata('pesan', 'Mengirim Ulang Berhasil, Silahkan cek kembali email anda');
            return redirect()->to('/login/verifikasi_lupa_password/' . $username);
        } else {
            session()->setFlashdata('pesan', 'Mengirim Ulang Gagal');
            return redirect()->to('/login/verifikasi_lupa_password/' . $username);
        }
    }

    public function logout()
    {
        session_destroy();
        return redirect()->to('/');
    }
}
