<?php

namespace App\Controllers;

use \App\Models\Artikel;

use \App\Models\PrestasiCyber;

use \App\Models\AnggotaCyber;

use \App\Models\Komentar;

use \App\Models\Donasi;

use \App\Models\Absen;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;

use App\Libraries\Midtrans;

class User extends BaseController
{
    protected $email;
    protected $artikel;
    protected $prestasi;
    protected $anggota;
    protected $komentar;
    protected $donasi;
    protected $absen;
    protected $midtrans;

    public function __construct()
    {
        $this->anggota = new AnggotaCyber();
        $this->email = \Config\Services::email();
        $this->artikel = new Artikel();
        $this->prestasi = new PrestasiCyber();
        $this->komentar = new Komentar();
        $this->donasi = new Donasi();
        $this->absen = new Absen();
        $this->midtrans = new Midtrans();
        $params = array('server_key' => 'SB-Mid-server-mnKUQ0BIrsfC2_5azYXTisEU', 'production' => false);
        $this->midtrans->config($params);
    }

    public function index()
    {
        // header("Access-Control-Allow-Headers: Authorization, Content-Type");
        // header("Access-Control-Allow-Origin: *");
        // header('content-type: application/json; charset=utf-8');
        // dd(json_decode(file_get_contents('https://api.kawalcorona.com/indonesia/provinsi', 1)));
        // setcookie('map_id', 1, time() + 10);
        $data = [
            'prestasi' => $this->prestasi,
            'anggota' => $this->anggota,
            'artikel' => $this->artikel->paginate(4, 'artikel'),
            'pager' => $this->artikel->pager,
            'corona' => json_decode(file_get_contents('https://api.kawalcorona.com/indonesia', 1))
        ];

        return view('pages/user/index', $data);
    }

    public function api_corona_indo()
    {
        $data_corona = file_get_contents('https://api.kawalcorona.com/indonesia', 1);

        return $data_corona;
    }

    public function api_corona_prov()
    {
        $data_corona = file_get_contents('https://api.kawalcorona.com/indonesia/provinsi', 1);

        return $data_corona;
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

    public function donasi()
    {
        if (!isset($_SESSION['user'])) {
            return redirect()->to('/login');
        } else {
            $data = [
                'data_donasi' => $this->donasi->where(['nama' => $_SESSION['user'][0]['nama']])->findAll(),
                'jumlah_donasi' => $this->donasi->jumlah(),
                'jumlah_pendonasi' => $this->donasi->countAllResults()
            ];
            return view('pages/user/donasi', $data);
        }
    }

    public function token()
    {

        // Required
        $transaction_details = array(
            'order_id' => rand(),
            'gross_amount' => $this->request->getVar('uang'), // no decimal allowed for creditcard
        );

        // Optional
        $item1_details = array(
            'id' => rand(),
            'price' => $this->request->getVar('uang'),
            'quantity' => 1,
            'name' => "Donasi Proker"
        );

        // Optional
        // $item2_details = array(
        //     'id' => 'a2',
        //     'price' => 20000,
        //     'quantity' => 2,
        //     'name' => "Orange"
        // );

        // Optional
        $item_details = $item1_details;

        // Optional
        $billing_address = array(
            'first_name'    => $_SESSION['user'][0]['nama'],
            'address'       => $_SESSION['user'][0]['alamat'],
            'phone'         => $_SESSION['user'][0]['no_tlp'],
            'country_code'  => 'IDN',
            'postal_code' =>   $this->request->getVar('catatan')
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Cyber Creative",
            'address'       => "SMK INSAN KREATIF Kel. Pabuaran, Kec. Cibinong, Kab. Bogor ",
            'phone'         => "08113366345",
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => $_SESSION['user'][0]['nama'],
            'email'         => $_SESSION['user'][0]['email'],
            'phone'         => $_SESSION['user'][0]['no_tlp'],
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O", $time),
            'unit' => 'minute',
            'duration'  => 2
        );

        $transaction_data = array(
            'transaction_details' => $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

        error_log(json_encode($transaction_data));
        $snapToken = $this->midtrans->getSnapToken($transaction_data);
        error_log($snapToken);
        echo $snapToken;
    }

    public function finish()
    {
        $result = json_decode($this->request->getVar('result_data'), true);
        // dd($result);
        $this->donasi->save([
            'id_pembayaran' => $result['order_id'],
            'jenis_pembayaran' => $result['payment_type'],
            'nama' => $_SESSION['user'][0]['nama'],
            'angkatan' => $_SESSION['user'][0]['angkatan'],
            'email' => $_SESSION['user'][0]['email'],
            'no_tlp' => $_SESSION['user'][0]['no_tlp'],
            'alamat' => $_SESSION['user'][0]['alamat'],
            'catatan' => $this->request->getVar('catatan'),
            'nominal' => substr($result['gross_amount'], 0, -3),
            'status' => $result['transaction_status']
        ]);
        session()->setFlashdata('pesan', 'Donasi Berhasil diKirim Silahkan Selesaikan Pembayaran');
        return redirect()->to('/user/donasi');
    }

    public function absen()
    {
        if (!isset($_SESSION['user'])) {
            return redirect()->to('/login');
        } else {
            $data = [
                'absen' => $this->absen->findAll()
            ];
            return view('/pages/user/absen', $data);
        }
    }

    public function upload_absen()
    {
        if (!isset($_SESSION['user'])) {
            return redirect()->to('/login');
        } else {
            if (!$this->validate([
                'id_user' => 'is_unique[absen.id_user]'
            ])) {
                session()->setFlashdata('pesan', 'Anda Sudah Absen');
                return redirect()->redirect('/user/absen');
            }
            $encoded_data = $this->request->getVar('mydata');
            $id_user = $this->request->getVar('id_user');
            $lat = $this->request->getVar('lat');
            $long = $this->request->getVar('long');
            $binary_data = base64_decode($encoded_data);
            $filename_webcam = $_SESSION['user'][0]['nama'] . '-' . date('Y-m-d') . '.jpg';
            $result = file_put_contents(FCPATH . '/dist/img/absen/' . $filename_webcam, $binary_data);
            $this->absen->save([
                'id_user' => $id_user,
                'nama' => $_SESSION['user'][0]['nama'],
                'angkatan' => $_SESSION['user'][0]['angkatan'],
                'lat' => $lat,
                'long' => $long,
                'jam' => date('H:i:s'),
                'tanggal' => date('Y-m-d'),
                'foto' => $filename_webcam
            ]);
            if (!$result) die("Could not save image!  Check file permissions.");
            session()->setFlashdata('pesan', 'Absensi Berhasil');
            return redirect()->to('/user/absen');
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
