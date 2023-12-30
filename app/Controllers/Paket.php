<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\ModelKategori;
use App\Models\ModelSatuan;

class Paket extends BaseController
{
	public function __construct()
	{
		$this->barang = new Modelbarang();
	}
	public function index()
	{
		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_barang', $cari);
			redirect()->to('Paket/index');
		} else {
			$cari = session()->get('cari_barang');
		}

		$totaldata = $cari ? $this->barang->tampildata_cari($cari)->countAllResults() : $this->barang->tampildata()->countAllResults();

		$dataBarang = $cari ? $this->barang->tampildata_cari($cari)->paginate(10, 'barang') : $this->barang->tampildata()->paginate(10, 'barang');

		$nohalaman = $this->request->getVar('page_barang') ? $this->request->getVar('page_barang') : 1;

		$data = [
			'tampildata' => $dataBarang,
			'pager' => $this->barang->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,

		];
		return view('Paket/viewbarang', $data);
	}

	public function tambah()
	{

		$Modelsatuan = new ModelSatuan();

		$data = [

			'datasatuan' => $Modelsatuan->findAll()
		];

		return view('Paket/formtambah', $data);
	}

	public function simpandata()
	{

		$kodebarang = $this->request->getPost('kodebarang');
		$namabarang = $this->request->getPost('namabarang');
		$harga = $this->request->getPost('hargabarang');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([


			'namabarang' => [
				'rules' => 'required',
				'label' => 'NAMA PAKET',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],

			'hargabarang' => [
				'rules' => 'required|numeric',
				'label' => 'HARGA PAKET',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
					'numeric' => '{field} HANYA BOLEH ANGKA',
				]
			]


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
			return redirect()->to('Paket/tambah');
		} else {




			$this->barang->insert([

				'namapaket' => $namabarang,
				'harga' => $harga,



			]);

			$pesanSukses = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA PAKET DENGAN NAMA <strong>' . $namabarang . '</strong> BERHASIL DISIMPAN
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanSukses);
			return redirect()->to('Paket/index');
		}
	}

	public function edit($kode)
	{
		$cekdata = $this->barang->find($kode);

		if ($cekdata) {


			$Modelsatuan = new ModelSatuan();

			$data = [
				'kode' => $kode,
				'namabarang' => $cekdata['namapaket'],
				'harga' => $cekdata['harga'],
				'datasatuan' => $Modelsatuan->findAll(),


			];

			return view('Paket/formeditbarang', $data);
		} else {
			$pesanEror = [
				'sukses' => '<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA BARANG DENGAN KODE <strong>' . $kode . '</strong> TIDAK DITEMUKAN
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanEror);
			return redirect()->to('Paket/index');
		}
	}

	public function updatedata()
	{

		$kodebarang = $this->request->getPost('kodebarang');
		$namabarang = $this->request->getPost('namabarang');
		$harga = $this->request->getPost('hargabarang');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'namabarang' => [
				'rules' => 'required',
				'label' => 'NAMA BARANG',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],


			'hargabarang' => [
				'rules' => 'required|numeric',
				'label' => 'HARGA BARANG',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
					'numeric' => '{field} HANYA BOLEH ANGKA',
				]
			]



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
			return redirect()->to('Paket/edit/' . $kodebarang);
		} else {


			$this->barang->update($kodebarang, [
				'namapaket' => $namabarang,
				'harga' => $harga


			]);

			$pesanSukses = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA PAKET DENGAN KODE <strong>' . $kodebarang . '</strong> BERHASIL DI UPDATE
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanSukses);
			return redirect()->to('Paket/index');
		}
	}
	public function hapus()
	{

			

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$Modelbarang = new Modelbarang();

			$Modelbarang->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}
