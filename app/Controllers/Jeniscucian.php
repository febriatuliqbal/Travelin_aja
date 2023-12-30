<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbarang;
use App\Models\Modeljeniscucian;
use App\Models\ModelSatuan;

class Jeniscucian extends BaseController
{
	public function __construct()
	{
		$this->barang = new Modeljeniscucian();
	}
	public function index()
	{
		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_barang', $cari);
			redirect()->to('Jeniscucian/index');
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
		return view('Jeniscucian/viewbarang', $data);
	}

	public function tambah()
	{

		$Modelsatuan = new ModelSatuan();

		$data = [

			'datasatuan' => $Modelsatuan->findAll()
		];

		return view('Jeniscucian/formtambah', $data);
	}

	public function simpandata()
	{

		$kodebarang = $this->request->getPost('kodebarang');
		$namabarang = $this->request->getPost('namabarang');
		$satuan = $this->request->getPost('satuan');
		$harga = $this->request->getPost('hargabarang');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([


			'namabarang' => [
				'rules' => 'required',
				'label' => 'NAMA CUCIAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],

			'satuan' => [
				'rules' => 'required',
				'label' => 'SATUAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
				]
			],

			'hargabarang' => [
				'rules' => 'required|numeric',
				'label' => 'HARGA CUCIAN',
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
			return redirect()->to('Jeniscucian/tambah');
		} else {




			$this->barang->insert([

				'namajeniscucian' => $namabarang,
				'satuan' => $satuan,
				'hargajc' => $harga,



			]);

			$pesanSukses = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
		  DATA CUCIAN DENGAN NAMA <strong>' . $namabarang . '</strong> BERHASIL DISIMPAN
		 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		 </div> '

			];

			session()->setFlashdata($pesanSukses);
			return redirect()->to('Jeniscucian/index');
		}
	}

	public function edit($kode)
	{
		$cekdata = $this->barang->find($kode);

		if ($cekdata) {


			$Modelsatuan = new ModelSatuan();

			$data = [
				'kode' => $kode,
				'namabarang' => $cekdata['namajeniscucian'],
				'satuan' => $cekdata['satuan'],
				'harga' => $cekdata['hargajc'],
				'datasatuan' => $Modelsatuan->findAll(),


			];

			return view('Jeniscucian/formeditbarang', $data);
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
			return redirect()->to('Jeniscucian/index');
		}
	}

	public function updatedata()
	{

		$kodebarang = $this->request->getPost('kodebarang');
		$namabarang = $this->request->getPost('namabarang');
		$satuan = $this->request->getPost('satuan');
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

			'satuan' => [
				'rules' => 'required',
				'label' => 'SATUAN BARANG',
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
			return redirect()->to('Jeniscucian/edit/' . $kodebarang);
		} else {


			$this->barang->update($kodebarang, [
				'namajeniscucian' => $namabarang,
				'satuan' => $satuan,
				'hargajc' => $harga


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
			return redirect()->to('Jeniscucian/index');
		}
	}
	public function hapus()
	{
		
		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$Modeljeniscucian = new Modeljeniscucian();

			$Modeljeniscucian->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}
