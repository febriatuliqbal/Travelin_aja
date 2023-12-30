<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelLogin;
use App\Models\Modelpelanggan;
use App\Models\Modelpihaktravel;
use CodeIgniter\Exceptions\AlertError;
use Config\Validation;

class Login extends BaseController
{

	public function __construct()
	{
		$this->pelanggan = new Modelpelanggan();
	}

	public function index()
	{
		return view('login/index');
	}

	public function login()
	{
		return view('lamandepan/logindepan');
	}


	public function loginpihaktravel()
	{
		return view('pihaktravel/loginpihaktravel');
	}



	public function konfirmasidaftar()
	{
		return view('lamandepan/konfirmasidaftar');
	}



	public function cekuser()
	{
		$iduser = $this->request->getPost('iduser');
		$pass = $this->request->getPost('pass');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'iduser' => [
				'rules' => 'required',
				'label' => 'ID USER',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],
			'pass' => [
				'rules' => 'required',
				'label' => 'PASSWORD',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',


				]
			],
		]);
		if (!$valid) {
			$sessErorr = [
				'errIdUser' => $validation->getError('iduser'),
				'errPassword' => $validation->getError('pass'),

			];

			session()->setFlashdata($sessErorr);
			return redirect()->to('/login/index');
		} else {

			$modelLogin = new ModelLogin();

			$cekUserLogin = $modelLogin->find($iduser);

			if ($cekUserLogin == null) {

				$sessErorr = [
					'errIdUser' => 'MAAF USER TIDAK TERDAFTAR',

				];

				session()->setFlashdata($sessErorr);
				return redirect()->to('/login/index');
			} else {
				$passwordUser = $cekUserLogin['pengpass'];
				if (password_verify($pass, $passwordUser)) {

					$idlevel = $cekUserLogin['penglevel'];
					$namauser = $cekUserLogin['pengnama'];

					$simpan_sesion = [
						'iduser' => $iduser,
						'namauser' => $namauser,
						'idlevel' => $idlevel,
					];

					session()->set($simpan_sesion);

					return redirect()->to('/main/index');
				} else {

					$sessErorr = [
						'errPassword' => 'MAAF PASSWORD SALAH',

					];

					session()->setFlashdata($sessErorr);
					return redirect()->to('/login/index');
				}
			}
		}
	}

	public function cekuserumum()
	{
		$iduser = $this->request->getPost('iduser');
		$pass = $this->request->getPost('pass');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'iduser' => [
				'rules' => 'required',
				'label' => 'ID USER',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],
			'pass' => [
				'rules' => 'required',
				'label' => 'PASSWORD',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',


				]
			],
		]);
		if (!$valid) {
			$sessErorr = [
				'errIdUser' => $validation->getError('iduser'),
				'errPassword' => $validation->getError('pass'),

			];

			session()->setFlashdata($sessErorr);
			return redirect()->to('/login/login');
		} else {

			$modelLogin = new Modelpelanggan();

			$cekUserLogin = $modelLogin->find($iduser);

			if ($cekUserLogin == null) {

				$sessErorr = [
					'errIdUser' => 'MAAF USER TIDAK TERDAFTAR',

				];

				session()->setFlashdata($sessErorr);
				return redirect()->to('/login/login');
			} else {
				$passwordUser = $cekUserLogin['passwordpelanggan'];
				if ($pass == $passwordUser) {

					$idlevel = $cekUserLogin['userlevelid'];
					$namauser = $cekUserLogin['namapelanggan'];
					$alamatpelannggan = $cekUserLogin['alamatpelannggan'];
					$hppelanggan = $cekUserLogin['hppelanggan'];
					$poinpelanggan = $cekUserLogin['poinpelanggan'];

					$simpan_sesion = [
						'iduser' => $iduser,
						'namauser' => $namauser,
						'idlevel' => $idlevel,
						'alamatpelannggan' => $alamatpelannggan,
						'hppelanggan' => $hppelanggan,
						'poinpelanggan' => $poinpelanggan,

					];

					session()->set($simpan_sesion);
					return redirect()->to('/lamandepan/index');
				} else {

					$sessErorr = [
						'errPassword' => 'MAAF PASSWORD SALAH',

					];

					session()->setFlashdata($sessErorr);
					return redirect()->to('/login/login');
				}
			}
		}
	}

	public function cekusertravel()
	{
		$iduser = $this->request->getPost('iduser');
		$pass = $this->request->getPost('pass');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'iduser' => [
				'rules' => 'required',
				'label' => 'ID USER',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],
			'pass' => [
				'rules' => 'required',
				'label' => 'PASSWORD',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',


				]
			],
		]);
		if (!$valid) {
			$sessErorr = [
				'errIdUser' => $validation->getError('iduser'),
				'errPassword' => $validation->getError('pass'),

			];

			session()->setFlashdata($sessErorr);
			return redirect()->to('/login/loginpihaktravel');
		} else {

			$modelLogin = new Modelpihaktravel();
			$cekUserLogin = $modelLogin->find($iduser);

			if ($cekUserLogin == null) {

				$sessErorr = [
					'errIdUser' => 'MAAF USER TIDAK TERDAFTAR',

				];

				session()->setFlashdata($sessErorr);
				return redirect()->to('/login/loginpihaktravel');
			} else {
				$passwordUser = $cekUserLogin['password'];
				if ($pass == $passwordUser) {

					$idlevel = $cekUserLogin['idlevel'];

					$namapihaktravel = $cekUserLogin['namapihaktravel'];
					$alamatpihaktravel = $cekUserLogin['alamatpihaktravel'];
					$telppihaktravel = $cekUserLogin['telppihaktravel'];
					$simpan_sesion = [
						'idlevel' => $idlevel,
						'iduser' => $iduser,
						'namauser' => $namapihaktravel,
						'alamatpihaktravel' => $alamatpihaktravel,
						'telppihaktravel' => $telppihaktravel,


					];
					session()->set($simpan_sesion);
					return redirect()->to('/main/index');
				} else {

					$sessErorr = [
						'errPassword' => 'MAAF PASSWORD SALAH',

					];

					session()->setFlashdata($sessErorr);
					return redirect()->to('/login/loginpihaktravel');
				}
			}
		}
	}

	public function keluar()
	{
		session()->destroy();
		return redirect()->to('/login/index');
	}
	public function keluarumum()
	{
		session()->destroy();
		return redirect()->to('/login/login');
	}

	public function daftar()
	{
		return view('lamandepan/daftardepan');
	}

	public function daftratravel()
	{
		return view('pihaktravel/daftrapihaktravel');
	}

	public function simpandaftar()
	{

		$usenamepelanggan = $this->request->getPost('usernamepelanggan');
		$password = $this->request->getPost('password');
		$namapelanggan = $this->request->getPost('namapelanggan');
		$alamat = $this->request->getPost('alamat');
		$hppelanggan = $this->request->getPost('nohp');

		$this->pelanggan->insert([
			'usenamepelanggan' => $usenamepelanggan,
			'passwordpelanggan' => $password,
			'namapelanggan' => $namapelanggan,
			'alamatpelannggan' => $alamat,
			'hppelanggan' => $hppelanggan,
			'poinpelanggan' => 20000,

			'userlevelid' => "4",


		]);

		return redirect()->to('/login/konfirmasidaftar');
	}

	public function simpandatatravel()
	{
		$username = $this->request->getPost('username');
		$pass = $this->request->getPost('pass');
		$nama = $this->request->getPost('nama');
		$alamat = $this->request->getPost('alamat');
		$nohp = $this->request->getPost('nohp');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'username' => [
				'rules' => 'required',
				'label' => 'username',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',


				]
			]
		]);

		if (!$valid) {
			$pesan = [
				'error' => '<div class ="alert alert-danger">' . $validation->getError() . '</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('Pihaktravel/formtambah');
		} else {
			$Modelpihaktravel = new Modelpihaktravel();

			$Modelpihaktravel->insert([
				'idpihaktravel' => $username,
				'password' => $pass,
				'namapihaktravel' => $nama,
				'alamatpihaktravel' => $alamat,
				'telppihaktravel' => $nohp,
				'idlevel' => 2,

			]);

			$pesan = [
				'sukses' => '<div class ="alert alert-success">YEYY.. DATA BERHASIL DISIMPAN</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('/login/konfirmasidaftar');
		}
	}
}