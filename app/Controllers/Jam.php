<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelJam;
use App\Models\ModelRute;

class Jam extends BaseController
{
	public function __construct()
	{
		$this->jam = new ModelJam();
	}
	public function index()
	{

		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_jam', $cari);
			redirect()->to('Jam/index');
		} else {
			$cari = session()->get('cari_jam');
		}

		$datajam = $cari ? $this->jam->cariData($cari)->paginate(5, 'jam') : $this->jam->tampildata()->paginate(5, 'jam');

		$nohalaman = $this->request->getVar('page_jam') ? $this->request->getVar('page_jam') : 1;
		$data = [
			'tampildata' => $datajam,
			'pager' => $this->jam->pager,
			'nohalaman' => $nohalaman,
			'cari' => $cari
		];
		return view('jam/viewjam', $data);
	}
	public function formtambah()
	{

		$ModelRute = new ModelRute();

		$data = [
			'datarute' => $ModelRute->findAll(),

		];
		return view('jam/formtambah', $data);
	}

	public function simpandata()
	{

		$rute = $this->request->getPost('rute');
		$tgl = $this->request->getPost('tgl');
		$jam = $this->request->getPost('jam');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'rute' => [
				'rules' => 'required',
				'label' => 'rute',
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
			return redirect()->to('jam/formtambah');
		} else {

			$this->jam->insert([
				'idrutejam' => $rute,
				'tgljam' => $tgl,
				'namajam' => $jam,
				'bangku' => "7",

			]);

			$pesan = [
				'sukses' => '<div class ="alert alert-success">YEYY.. DATA BERHASIL DISIMPAN</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('jam/index');
		}
	}
	public function formedit($id)
	{
		$rowData = $this->jam->find($id);

		if ($rowData) {
			$data = [
				'idjam' => $id,
				'asal_tujuan' => $rowData['asal_tujuan'],
				'harga' => $rowData['harga'],
			];
			return view('jam/formeditjam', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}
	public function updatedata()
	{
		$idjam = $this->request->getPost('idjam');
		$asal = $this->request->getPost('asal');
		$tujuan = $this->request->getPost('tujuan');
		$harga = $this->request->getPost('harga');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'asal' => [
				'rules' => 'required',
				'label' => 'NAMA jam',
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
			return redirect()->to('jam/formedit/' . $idjam);
		} else {

			$this->jam->update($idjam, [
				'asal_tujuan' => $asal,
				'harga' => $harga,
			]);

			$pesan = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
			Data jam Berhasil Di-Update
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'
			];


			session()->setFlashdata($pesan);
			return redirect()->to('jam/index');
		}
	}

	public function hapus()
	{

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$ModelJam = new ModelJam();

			$ModelJam->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}