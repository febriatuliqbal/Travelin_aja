<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelRute;

class Rute extends BaseController
{
	public function __construct()
	{
		$this->rute = new ModelRute();
	}
	public function index()
	{

		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_rute', $cari);
			redirect()->to('Rute/index');
		} else {
			$cari = session()->get('cari_rute');
		}

		$datarute = $cari ? $this->rute->cariData($cari)->paginate(10, 'rute') : $this->rute->tampildata()->paginate(100, 'rute');

		$nohalaman = $this->request->getVar('page_rute') ? $this->request->getVar('page_rute') : 1;
		$data = [
			'tampildata' => $datarute,
			'pager' => $this->rute->pager,
			'nohalaman' => $nohalaman,
			'cari' => $cari
		];
		return view('rute/viewrute', $data);
	}
	public function formtambah()
	{

		return view('rute/formtambah');
	}

	public function simpandata()
	{

		$asal = $this->request->getPost('asal');

		$harga = $this->request->getPost('harga');
		$mobil = $this->request->getPost('mobil');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'asal' => [
				'rules' => 'required',
				'label' => 'ASAL',
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
			return redirect()->to('rute/formtambah');
		} else {

			$this->rute->insert([
				'asal_tujuan' => $asal,
				'harga' => $harga,
				'mobil' => $mobil,
				'jumlahulasan' => 0,
				'idtravel' => session()->iduser
			]);

			$pesan = [
				'sukses' => '<div class ="alert alert-success">YEYY.. DATA BERHASIL DISIMPAN</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('rute/index');
		}
	}
	public function formedit($id)
	{
		$rowData = $this->rute->find($id);

		if ($rowData) {
			$data = [
				'idrute' => $id,
				'asal_tujuan' => $rowData['asal_tujuan'],
				'harga' => $rowData['harga'],
				'mobil' => $rowData['mobil'],
			];
			return view('rute/formeditrute', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}
	public function updatedata()
	{
		$idrute = $this->request->getPost('idrute');
		$asal = $this->request->getPost('asal');
		$mobil = $this->request->getPost('mobil');
		$harga = $this->request->getPost('harga');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'asal' => [
				'rules' => 'required',
				'label' => 'NAMA rute',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG'


				]
			]
		]);

		if (!$valid) {
			$pesan = [
				'errornama' => '<div class ="alert alert-danger">' . $validation->getError() . '</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('rute/formedit/' . $idrute);
		} else {

			$this->rute->update($idrute, [
				'asal_tujuan' => $asal,
				'harga' => $harga,
				'mobil' => $mobil,
			]);

			$pesan = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
			Data rute Berhasil Di-Update
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'
			];


			session()->setFlashdata($pesan);
			return redirect()->to('rute/index');
		}
	}

	public function hapus()
	{

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$ModelRute = new ModelRute();

			$ModelRute->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}