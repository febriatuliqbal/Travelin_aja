<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelpelanggan;

class Pelanggan extends BaseController
{
	public function __construct()
	{
		$this->pelanggan = new Modelpelanggan();
	}
	public function index()
	{
		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_pelanggan', $cari);
			redirect()->to('pelanggan/index');
		} else {
			$cari = session()->get('cari_pelanggan');
		}

		$totaldata = $cari ? $this->pelanggan->tampildata_cari($cari)->countAllResults() : $this->pelanggan->tampildata()->countAllResults();

		$datapelanggan = $cari ? $this->pelanggan->tampildata_cari($cari)->paginate(5, 'pelanggan') : $this->pelanggan->tampildata()->paginate(5, 'pelanggan');

		$nohalaman = $this->request->getVar('page_pelanggan') ? $this->request->getVar('page_pelanggan') : 1;

		$data = [
			'tampildata' => $datapelanggan,
			'pager' => $this->pelanggan->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,

		];
		return view('pelanggan/viewpelanggan', $data);
	}

	public function tambah()
	{

		return view('pelanggan/formtambah');
	}

	public function simpandata()
	{

		$usenamepelanggan = $this->request->getPost('usernamepelanggan');
		$password = $this->request->getPost('password');
		$namapelanggan = $this->request->getPost('namapelanggan');
		$alamat = $this->request->getPost('alamat');
		$hppelanggan = $this->request->getPost('nohp');



		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([

			'usernamepelanggan' => [
				'rules' => 'required|is_unique[pelanggan.usenamepelanggan]',
				'label' => 'USERNAME PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
					'is_unique' => '{field} SUDAH ADA, COBA YANG  LAIN',

				]
			],

			'namapelanggan' => [
				'rules' => 'required',
				'label' => 'PASSWORD PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],

			'namapelanggan' => [
				'rules' => 'required',
				'label' => 'NAMA PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],

			'alamat' => [
				'rules' => 'required',
				'label' => 'KATEGORI PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
				]
			],

			'nohp' => [
				'rules' => 'required',
				'label' => 'NO HP PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
				]
			],




		]);

		if (!$valid) {
			$pesan = [
				'error' => '
			  <div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> EROR!!</h5>
			' . $validation->listErrors() . '
		   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		   </div> '

			];

			session()->setFlashdata($pesan);
			return redirect()->to('pelanggan/tambah');
		} else {

			$this->pelanggan->insert([
				'usenamepelanggan' => $usenamepelanggan,
				'passwordpelanggan' => $password,
				'namapelanggan' => $namapelanggan,
				'alamatpelannggan' => $alamat,
				'hppelanggan' => $hppelanggan,
				'userlevelid' => "4",


			]);

			$pesanSukses = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA pelanggan DENGAN KODE <strong>' . $namapelanggan . '</strong> BERHASIL DISIMPAN
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanSukses);
			return redirect()->to('pelanggan/index');
		}
	}

	public function edit($kode)
	{
		$cekdata = $this->pelanggan->find($kode);

		if ($cekdata) {

			$data = [
				'usenamepelanggan' => $cekdata['usenamepelanggan'],
				'namapelanggan' => $cekdata['namapelanggan'],
				'alamat' => $cekdata['alamatpelannggan'],
				'nohp' => $cekdata['hppelanggan'],


			];

			return view('pelanggan/formeditpelanggan', $data);
		} else {
			$pesanEror = [
				'sukses' => '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA PELANGGAN DENGAN KODE <strong>' . $kode . '</strong> TIDAK DITEMUKAN
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanEror);
			return redirect()->to('pelanggan/index');
		}
	}

	public function updatedata()
	{

		$usenamepelanggan = $this->request->getPost('usenamepelanggan');
		$namapelanggan = $this->request->getPost('namapelanggan');
		$kategori = $this->request->getPost('alamat');
		$satuan = $this->request->getPost('nohp');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([


			'namapelanggan' => [
				'rules' => 'required',
				'label' => 'NAMA PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],

			'alamat' => [
				'rules' => 'required',
				'label' => 'KATEGORI PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
				]
			],

			'nohp' => [
				'rules' => 'required',
				'label' => 'SATUAN PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
				]
			],


		]);

		if (!$valid) {
			$pesan = [
				'erorupdate' => '
			  <div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> EROR!!</h5>
			' . $validation->listErrors() . '
		   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		   </div> '

			];

			session()->setFlashdata($pesan);
			return redirect()->to('pelanggan/edit/' . $usenamepelanggan);
		} else {


			$this->pelanggan->update($usenamepelanggan, [
				'namapelanggan' => $namapelanggan,
				'alamatpelannggan' => $kategori,
				'hppelanggan' => $satuan,


			]);

			$pesanSukses = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA pelanggan DENGAN KODE <strong>' . $usenamepelanggan . '</strong> BERHASIL DI UPDATE
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanSukses);
			return redirect()->to('pelanggan/index');
		}
	}
	public function hapus()
	{

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$modelpelanggan = new Modelpelanggan();

			$modelpelanggan->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}