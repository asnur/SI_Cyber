<?php

namespace App\Controllers;

// use Aes as GlobalAes;
use App\Models\AnggotaCyber;

use App\Models\PrestasiCyber;

use App\Models\Artikel;

use App\Models\Agenda;

use Config\Aes;

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\SMTP;

use PHPMailer\PHPMailer\Exception;



class Admin extends BaseController
{
	protected $anggota_cyber;
	protected $prestasi_cyber;
	protected $artikel;
	protected $agenda;
	// protected $aes;

	public function __construct()
	{
		$this->anggota_cyber = new AnggotaCyber();
		$this->prestasi_cyber = new PrestasiCyber();
		$this->artikel = new Artikel();
		$this->agenda = new Agenda();
		// $this->aes = new Aes();
	}

	public function index()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$z = "abcdefghijuklmno0123456789012345";
			$data = [
				'aes' => new Aes($z),
				'prestasi' => $this->prestasi_cyber,
				'jumlah_anggota' => $this->anggota_cyber->countAllResults(),
				'jumlah_prestasi' => $this->prestasi_cyber->countAllResults(),
				'jumlah_pendaftar' => $this->anggota_cyber->where(['status' => 'Calon'])->countAllResults(),
				'jumlah_agenda' => $this->agenda->countAllResults()
			];
			return view('pages/admin/home', $data);
		}
	}

	public function anggota()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$anggota = $this->anggota_cyber->findAll();
			$data = [
				'anggota' => $anggota
			];
			return view('pages/admin/anggota', $data);
		}
	}

	public function edit_anggota($username)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$detail_anggota = $this->anggota_cyber->where(['username' => $username])->first();
			$data = [
				'detail' => $detail_anggota,
				'validation' => \Config\Services::validation()
			];
			return view('pages/admin/edit/anggota', $data);
		}
	}

	public function tambah_anggota()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$z = "abcdefghijuklmno0123456789012345";
			$data = [
				'aes' => new Aes($z),
				'validation' => \Config\Services::validation()
			];
			return view('pages/admin/tambah/anggota', $data);
		}
	}

	public function save_tambah_anggota()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			if (!$this->validate([
				'username' => [
					'rules' => 'required|is_unique[anggota_new.username]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
					]
				],
				'nama' => [
					'rules' => 'required|is_unique[anggota_new.nama]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
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
				return redirect()->to('/admin/tambah_anggota')->withInput();
			}

			$fileFoto = $this->request->getFile('foto');

			if ($fileFoto->getError() == 4) {
				$namaFoto = '';
			} else {
				$namaFoto = $fileFoto->getName();
				$fileFoto->move('/dist/img/');
			}
			$this->anggota_cyber->save([
				'nama' => htmlspecialchars($this->request->getVar('nama')),
				'username' => htmlspecialchars($this->request->getVar('username')),
				'password' => md5(htmlspecialchars($this->request->getVar('password'))),
				'alamat' => htmlspecialchars($this->request->getVar('alamat')),
				'no_tlp' => htmlspecialchars($this->request->getVar('no_tlp')),
				'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
				'angkatan' => htmlspecialchars($this->request->getVar('angkatan')),
				'jabatan' => htmlspecialchars($this->request->getVar('jabatan')),
				'status' => htmlspecialchars($this->request->getVar('status')),
				'foto' => $namaFoto
			]);

			session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan');
			return redirect()->to('/admin/anggota');
		}
	}

	public function save_edit_anggota($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$dataLama = $this->anggota_cyber->where(['id' => $id])->first();
			$dataUsernameBaru = $this->request->getVar('username');
			$dataNamaBaru = $this->request->getVar('nama');
			if ($dataLama['username'] == $dataUsernameBaru || $dataLama['nama'] == $dataNamaBaru) {
				$rules = 'required';
			} else {
				$rules = 'required|is_unique[anggota_new.username]';
			}
			if (!$this->validate([
				'username' => [
					'rules' => $rules,
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
					]
				],
				'nama' => [
					'rules' => $rules,
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
					]
				],
				'foto' => [
					'rules' => 'max_size[foto,1024]|is_image[foto]',
					'errors' => [
						'max_size' => 'Ukuran Melebihi 1MB',
						'is_image' => 'File yang anda masukan bukan Gambar'
					]
				]
			])) {
				return redirect()->to('/admin/edit_anggota/' . $dataLama['username'] . '')->withInput();
			}

			$fileFoto = $this->request->getFile('foto');

			if ($fileFoto->getError() == 4) {
				$namaFoto = $this->request->getVar('fotoLama');
			} else {
				error_reporting(0);
				$namaFoto = $fileFoto->getName();
				$fileFoto->move('dist/img', $namaFoto);
				unlink('/dist/img/' . $this->request->getVar('fotoLama'));
			}
			$this->anggota_cyber->save([
				'id' => $id,
				'nama' => htmlspecialchars($this->request->getVar('nama')),
				'username' => htmlspecialchars($this->request->getVar('username')),
				'alamat' => htmlspecialchars($this->request->getVar('alamat')),
				'no_tlp' => htmlspecialchars($this->request->getVar('no_hp')),
				'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
				'angkatan' => htmlspecialchars($this->request->getVar('angkatan')),
				'jabatan' => htmlspecialchars($this->request->getVar('jabatan')),
				'status' => htmlspecialchars($this->request->getVar('status')),
				'foto' => $namaFoto
			]);
			session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');

			return redirect()->to('/admin/anggota');
		}
	}
	public function hapus_anggota($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$namaFoto = $this->anggota_cyber->find($id);
			if ($namaFoto['foto'] == '') {
				$this->anggota_cyber->delete($id);
				session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
				return redirect()->to('/admin/anggota');
			} else {
				unlink('dist/img/' . $namaFoto['foto']);
				$this->anggota_cyber->delete($id);
				session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
				return redirect()->to('/admin/anggota');
			}
		}
	}

	public function kartu_anggota($username)
	{
		$data_anggota = $this->anggota_cyber->where(['username' => $username])->first();
		$data = [
			'kartu' => $data_anggota
		];
		return view('/pages/admin/kartu/kartu_anggota', $data);
	}

	public function pendaftaran()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$detail_calon = $this->anggota_cyber->where(['status' => 'Calon'])->findAll();
			$data = [
				'calon' => $detail_calon
			];
			return view('/pages/admin/pendaftaran', $data);
		}
	}

	public function tambah_calon_anggota()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$data = [
				'validation' => \Config\Services::validation()
			];
			return view('pages/admin/tambah/calon_anggota', $data);
		}
	}

	public function save_tambah_calon_anggota()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			if (!$this->validate([
				'username' => [
					'rules' => 'required|is_unique[anggota_new.username]',
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
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
				return redirect()->to('/admin/tambah_calon_anggota')->withInput();
			}
			$fileFoto = $this->request->getFile('foto');

			if ($fileFoto->getError() == 4) {
				$namaFoto = '';
			} else {
				$namaFoto = $fileFoto->getName();
				$fileFoto->move('/dist/img/');
			}
			$this->anggota_cyber->save([
				'nama' => htmlspecialchars($this->request->getVar('nama')),
				'username' => htmlspecialchars($this->request->getVar('username')),
				'alamat' => htmlspecialchars($this->request->getVar('alamat')),
				'no_tlp' => htmlspecialchars($this->request->getVar('no_tlp')),
				'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
				'angkatan' => htmlspecialchars($this->request->getVar('angkatan')),
				'jabatan' => NULL,
				'status' => htmlspecialchars($this->request->getVar('status')),
				'foto' => $namaFoto
			]);
			session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan');

			return redirect()->to('/admin/pendaftaran');
		}
	}

	public function edit_calon_anggota($username)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$detail_anggota = $this->anggota_cyber->where(['username' => $username])->first();
			$data = [
				'detail' => $detail_anggota,
				'validation' => \Config\Services::validation()
			];
			return view('pages/admin/edit/calon_anggota', $data);
		}
	}

	public function save_edit_calon_anggota($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$dataLama = $this->anggota_cyber->where(['id' => $id])->first();
			$dataUsernameBaru = $this->request->getVar('username');
			$dataNamaBaru = $this->request->getVar('nama');
			if ($dataLama['username'] == $dataUsernameBaru && $dataLama['nama'] == $dataNamaBaru) {
				$rules = 'required';
			} else {
				$rules = 'required|is_unique[anggota_new.username]';
			}
			if (!$this->validate([
				'username' => [
					'rules' => $rules,
					'errors' => [
						'required' => '{field} tidak boleh kosong',
						'is_unique' => '{field} sudah ada / terdaftar'
					]
				],
				'nama' => [
					'rules' => $rules,
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
				return redirect()->to('/admin/edit_calon_anggota/' . $dataLama['username'] . '')->withInput();
			}
			$fileFoto = $this->request->getFile('foto');

			if ($fileFoto->getError() == 4) {
				$namaFoto = '';
			} else {
				$namaFoto = $fileFoto->getName();
				$fileFoto->move('/dist/img/');
			}
			$this->anggota_cyber->save([
				'id' => $id,
				'nama' => htmlspecialchars($this->request->getVar('nama')),
				'username' => htmlspecialchars($this->request->getVar('username')),
				'alamat' => htmlspecialchars($this->request->getVar('alamat')),
				'no_tlp' => htmlspecialchars($this->request->getVar('no_tlp')),
				'jenis_kelamin' => htmlspecialchars($this->request->getVar('jenis_kelamin')),
				'angkatan' => htmlspecialchars($this->request->getVar('angkatan')),
				'jabatan' => NULL,
				'status' => htmlspecialchars($this->request->getVar('status')),
				'foto' => $namaFoto
			]);
			session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');

			return redirect()->to('/admin/pendaftaran');
		}
	}

	public function hapus_calon_anggota($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$namaFoto = $this->anggota_cyber->find($id);
			if ($namaFoto['foto'] == '') {
				$this->anggota_cyber->delete($id);
				session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
				return redirect()->to('/admin/pendaftaran');
			} else {
				unlink('dist/img/' . $namaFoto['foto']);
				$this->anggota_cyber->delete($id);
				session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
				return redirect()->to('/admin/pendaftaran');
			}
		}
	}

	public function kartu_calon_anggota($username)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$data_anggota = $this->anggota_cyber->where(['username' => $username])->first();
			$data = [
				'kartu' => $data_anggota
			];
			return view('/pages/admin/kartu/kartu_calon_anggota', $data);
		}
	}

	public function prestasi()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$prestasi = $this->prestasi_cyber->findAll();
			$data = [
				'prestasi' => $prestasi
			];
			return view('/pages/admin/prestasi', $data);
		}
	}

	public function tambah_prestasi()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$namaAnggota = $this->anggota_cyber->findAll();
			$data = [
				'validation' => \Config\Services::validation(),
				'anggota' => $namaAnggota
			];
			return view('/pages/admin/tambah/prestasi', $data);
		}
	}

	public function save_tambah_prestasi()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			if (!$this->validate([
				'nama' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'angkatan' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'jenis_prestasi' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'angkatan' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tahun' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tempat' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				]
			])) {
				return redirect()->to('/admin/tambah_prestasi')->withInput();
			}

			$namaAnggota = $this->request->getVar('nama');
			$pilihAnggota = "";
			foreach ($namaAnggota as $nama) {
				$pilihAnggota .= $nama . ", ";
			}
			$pilihAnggota = substr($pilihAnggota, 0, -2);

			$angkatan = $this->request->getVar('angkatan');
			$pilih_angkatan = "";
			foreach ($angkatan as $angkatan_cyber) {
				$pilih_angkatan .= $angkatan_cyber . ", ";
			}
			$pilih_angkatan = substr($pilih_angkatan, 0, -2);

			$this->prestasi_cyber->save([
				'nama' => $pilihAnggota,
				'angkatan' => $pilih_angkatan,
				'jenis_prestasi' => $this->request->getVar('jenis_prestasi'),
				'tahun' => $this->request->getVar('tahun'),
				'tempat' => $this->request->getVar('tempat')
			]);

			session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan');

			return redirect()->to('/admin/prestasi');
		}
	}

	public function edit_prestasi($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$prestasi = $this->prestasi_cyber->where(['id' => $id])->first();
			$namaAnggota = $this->anggota_cyber->findAll();
			$data = [
				'validation' => \Config\Services::validation(),
				'prestasi' => $prestasi,
				'anggota' => $namaAnggota
			];
			return view('pages/admin/edit/prestasi', $data);
		}
	}

	public function save_edit_prestasi($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			if (!$this->validate([
				'nama' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'angkatan' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'jenis_prestasi' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'angkatan' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tahun' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'tempat' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				]
			])) {
				return redirect()->to('/admin/edit_prestasi/' . $id . '')->withInput();
			}

			$namaAnggota = $this->request->getVar('nama');
			$pilihAnggota = "";
			foreach ($namaAnggota as $nama) {
				$pilihAnggota .= $nama . ", ";
			}
			$pilihAnggota = substr($pilihAnggota, 0, -2);

			$angkatan = $this->request->getVar('angkatan');
			$pilih_angkatan = "";
			foreach ($angkatan as $angkatan_cyber) {
				$pilih_angkatan .= $angkatan_cyber . ", ";
			}
			$pilih_angkatan = substr($pilih_angkatan, 0, -2);

			$this->prestasi_cyber->save([
				'id' => $id,
				'nama' => $pilihAnggota,
				'angkatan' => $pilih_angkatan,
				'jenis_prestasi' => $this->request->getVar('jenis_prestasi'),
				'tahun' => $this->request->getVar('tahun'),
				'tempat' => $this->request->getVar('tempat')
			]);

			session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');

			return redirect()->to('/admin/prestasi');
		}
	}

	public function hapus_prestasi($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$this->prestasi_cyber->delete($id);
			session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
			return redirect()->to('/admin/prestasi');
		}
	}

	public function artikel()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$artikel = $this->artikel->findAll();
			$data = [
				'artikel' => $artikel
			];
			return view('pages/admin/artikel', $data);
		}
	}

	public function hapus_artikel($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$namaFoto = $this->artikel->find($id);
			unlink('dist/img/cover/' . $namaFoto['foto']);
			$this->artikel->delete($id);
			session()->setFlashdata('pesan', 'Data Berhasil Di Hapus');
			return redirect()->to('/admin/artikel');
		}
	}

	public function tambah_artikel()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$data = [
				'validation' => \Config\Services::validation()
			];

			return view('pages/admin/tambah/artikel.php', $data);
		}
	}

	public function save_tambah_artikel()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			if (!$this->validate([
				'judul' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'foto' => [
					'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
					'errors' => [
						'uploaded' => 'Cover Wajib di Upload',
						'max_size' => 'Ukuran Melebihi 1MB',
						'is_image' => 'File yang anda masukan bukan Gambar',
						'mime_in' => 'File yang anda masukan bukan Gambar'
					]
				],
				'isi' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				]
			])) {
				return redirect()->to('/admin/tambah_artikel')->withInput();
			}

			$fileFoto = $this->request->getFile('foto');
			$fileFoto->move('dist/img/cover/');

			$namaFoto = $fileFoto->getName();

			if (empty($this->request->getVar('tanggal'))) {
				$tanggal = date("Y-m-d");
			} else {
				$tanggal = $this->request->getVar('tanggal');
			}
			$this->artikel->save([
				'judul' => htmlspecialchars($this->request->getVar('judul')),
				'foto' => $namaFoto,
				'isi' => htmlspecialchars($this->request->getVar('isi')),
				'tanggal' => $tanggal
			]);

			session()->setFlashdata('pesan', 'Data Berhasil Di Tambahkan');
			return redirect()->to('/admin/artikel');
		}
	}

	public function edit_artikel($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$artikel = $this->artikel->where(['id' => $id])->first();
			$data = [
				'artikel' => $artikel,
				'validation' => \Config\Services::validation()
			];

			return view('pages/admin/edit/artikel', $data);
		}
	}

	public function save_edit_artikel($id)
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$fileFoto = $this->request->getFile('foto');

			if ($fileFoto->getError() == 4) {
				$namaFoto = $this->request->getVar('fotoLama');
			} else {
				error_reporting(0);
				$namaFoto = $fileFoto->getName();

				$fileFoto->move('dist/img/cover', $namaFoto);

				unlink('dist/img/cover/' . $this->request->getVar('fotoLama'));
			}

			if (!$this->validate([
				'judul' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				],
				'foto' => [
					'rules' => 'max_size[foto,1024]|is_image[foto]',
					'errors' => [
						'max_size' => 'Ukuran Melebihi 1MB',
						'is_image' => 'File yang anda masukan bukan Gambar'
					]
				],
				'isi' => [
					'rules' => 'required',
					'errors' => [
						'required' => '{field} tidak boleh kosong'
					]
				]
			])) {
				return redirect()->to('/admin/edit_artikel/' . $id)->withInput();
			}

			if (empty($this->request->getVar('tanggal'))) {
				$tanggal = date("Y-m-d");
			} else {
				$tanggal = $this->request->getVar('tanggal');
			}

			$this->artikel->save([
				'id' => $id,
				'judul' => htmlspecialchars($this->request->getVar('judul')),
				'foto' => $namaFoto,
				'isi' => htmlspecialchars($this->request->getVar('isi')),
				'tanggal' => $tanggal
			]);

			session()->setFlashdata('pesan', 'Data Berhasil Di Ubah');
			return redirect()->to('/admin/artikel');
		}
	}

	public function agenda()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$agenda = $this->agenda->findAll();

			$data = [
				'agenda' => $agenda
			];

			return view('pages/admin/agenda', $data);
		}
	}

	public function load_agenda()
	{
		$load = $this->agenda->load();
		foreach ($load as $row) {
			$data[] = array(
				'id'   => $row['id'],
				'title'   => $row['title'],
				'start'   => $row['start_event'],
				'end'   => $row['end_event']
			);

			return json_encode($data);
		}
	}

	public function tambah_agenda()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$this->agenda->save([
				'title' => htmlspecialchars($this->request->getVar('title')),
				'start_event' => $this->request->getVar('start'),
				'end_event' => $this->request->getVar('end')
			]);
		}
	}

	public function ubah_agenda()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$this->agenda->save([
				'id' => $this->request->getVar('id'),
				'title' => htmlspecialchars($this->request->getVar('title')),
				'start_event' => $this->request->getVar('start'),
				'end_event' => $this->request->getVar('end')
			]);
		}
	}

	public function hapus_agenda()
	{
		if (!isset($_SESSION['admin'])) {
			return view('pages/login/index');
		} else {
			$this->agenda->delete($this->request->getVar('id'));
		}
	}

	//--------------------------------------------------------------------

}
