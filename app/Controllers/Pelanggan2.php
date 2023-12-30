<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelDataPelanggan;
use App\Models\Modelpelanggan;
use config\Services;

class Pelanggan2 extends BaseController
{
	public function formtambah()
	{
		$json = [
			'data' => view('modelpelanggan/modaltambah')
		];
		echo json_encode($json);
	}

	public function simpan()
	{
		$namapel = $this->request->getPost('namapel');
		$alamatpel = $this->request->getPost('alamatpel');
		$telp = $this->request->getPost('telp');

		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([
			'namapel' => [
				'rules' => 'required',
				'label' => 'NAMA PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',

				]
			],
			'telp' => [
				'rules' => 'required|is_unique[pelanggan.hppelanggan]',
				'label' => 'NO HP/TELP PELANGGAN',
				'errors' => [
					'required' => '{field} TIDAK BOLEH KOSONG',
					'is_unique' => '{field} TIDAK BOLEH ADA YANG SAMA',

				]
			],
		]);

		//JIKA TIDAK FALID
		if (!$valid) {
			$json = [
				'error' => [
					'errNamaPelanggan' => $validation->getError('namapel'),
					'errTelp' => $validation->getError('telp'),
				]


			];
		} else {

			$ModelPelanggan = new Modelpelanggan();

			$ModelPelanggan->insert([
				'namapelanggan' => $namapel,
				'alamatpelannggan' => $alamatpel,
				'hppelanggan' => $telp,


			]);

			$rowData = $ModelPelanggan->ambildataterkhirdiinput()->getRowArray();

			$json = [
				'sukses' => 'DATA PELANGGAN BERHASIL DISIMPAN , AMBIL DATA TERAKHIR ?',
				'namapelanggan' => $rowData['namapelanggan'],
				'idpel' => $rowData['usenamepelanggan'],
				'nohp' => $rowData['hppelanggan'],
			];
		}
		echo json_encode($json);
	}

	public function modalDataPelanggan()
	{
		if ($this->request->isAJAX()) {

			$json = [
				'data' => view('modelpelanggan/modaldata')
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function listDataPelanggan()
	{
		$request = Services::request();
		$datamodel = new ModelDataPelanggan($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables();
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];
				$tombolpilih = "<button type=\"button\" class=\"btn  btn-sm btn-info\" onclick=\"pilih('" . $list->usenamepelanggan . "','" . $list->namapelanggan . "','" . $list->hppelanggan . "','" . $list->alamatpelannggan . "')\">Pilih</button>";
				$iconhapus = '<i class="fa fa-trash-alt"></i>';
				$tombolhapus = "<button type=\"button\" class=\"btn  btn-sm btn-danger\" onclick=\"hapus('" . $list->usenamepelanggan . "','" . $list->namapelanggan . "')\">$iconhapus</button> ";
				//isi tabel
				$row[] = $no;
				$row[] = $list->namapelanggan;
				$row[] = $list->alamatpelannggan;
				$row[] = $list->hppelanggan;
				$row[] = $tombolpilih . "  " . $tombolhapus;

				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $datamodel->count_all(),
				"recordsFiltered" => $datamodel->count_filtered(),
				"data" => $data
			];
			echo json_encode($output);
		}
	}

	public function hapus()
	{
		$id = $this->request->getPost('id');

		$ModelPelanggan = new ModelPelanggan();
		$ModelPelanggan->delete($id);

		$json = [
			'sukses' => "TRANSAKSI DENGAN KODE : $id , BERHASIL DIHAPUS"
		];
		echo json_encode($json);
	}
}