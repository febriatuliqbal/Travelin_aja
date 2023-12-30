<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeltemptransaksi;

class coba extends BaseController
{
	public function __construct()
	{
		$this->satuan = new Modeltemptransaksi();
	}
	public function index()
	{

		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_satuan', $cari);
			redirect()->to('satuan/index');
		} else {
			$cari = session()->get('cari_satuan');
		}

		$datasatuan = $cari ? $this->satuan->cariData($cari)->paginate(5, 'satuan') : $this->satuan->paginate(5, 'satuan');

		$nohalaman = $this->request->getVar('page_satuan') ? $this->request->getVar('page_satuan') : 1;
		$data = [
			'tampildata' => $datasatuan,
			'pager' => $this->satuan->pager,
			'nohalaman' => $nohalaman,
			'cari' => $cari
		];
		return view('satuan/viewsatuan', $data);
	}
	public function formtambah()
	{

		return view('satuan/formtambah');
	}

	public function simpandata()
	{

		$namasatuan = $this->request->getPost('namasatuan');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'namasatuan' => [
				'rules' => 'required|is_unique[satuan.namasatuan]',
				'label' => 'NAMA satuan',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
					'is_unique' => '{field} SUDAH ADA, COBA LAGI YANG LAIN'

				]
			]
		]);

		if (!$valid) {
			$pesan = [
				'errornama' => '<div class ="alert alert-danger">' . $validation->getError() . '</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('satuan/formtambah');
		} else {

			$this->satuan->insert([
				'namasatuan' => $namasatuan
			]);

			$pesan = [
				'sukses' => '<div class ="alert alert-success">YEYY.. DATA BERHASIL DISIMPAN</div>'

			];

			session()->setFlashdata($pesan);
			return redirect()->to('satuan/index');
		}
	}
	public function formedit($id)
	{
		$rowData = $this->satuan->find($id);

		if ($rowData) {
			$data = [
				'id' => $id,
				'nama' => $rowData['namasatuan'],
			];
			return view('satuan/formeditsatuan', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}
	public function updatedata()
	{

		$idsatuan = $this->request->getPost('idsatuan');
		$namasatuan = $this->request->getPost('namasatuan');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'namasatuan' => [
				'rules' => 'required',
				'label' => 'NAMA satuan',
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
			return redirect()->to('satuan/formedit/' . $idsatuan);
		} else {

			$this->satuan->update($idsatuan, [
				'namasatuan' => $namasatuan
			]);

			$pesan = [
				'sukses' => '<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			<h5><i class="icon fas fa-check"></i> SELAMAT!!</h5>
			Data satuan Berhasil Di-Update
		    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'
			];


			session()->setFlashdata($pesan);
			return redirect()->to('satuan/index');
		}
	}

	public function hapus()
	{		

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$ModelSatuan = new ModelSatuan();

			$ModelSatuan->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
}
