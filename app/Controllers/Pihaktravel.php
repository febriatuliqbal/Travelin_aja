<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbiayalayanan;
use App\Models\Modeldatataransaksi;
use App\Models\ModeldetailTransaksi;
use App\Models\ModelPaketWisata;
use App\Models\ModelRute;
use App\Models\ModelPaketWisataWisata;
use App\Models\Modelpelanggan;
use App\Models\Modelpihaktravel;
use App\Models\Modeltemptransaksi;
use App\Models\Modeltaransaksi;
use CodeIgniter\HTTP\Request;
use config\Services;





class Pihaktravel extends BaseController
{
	public function index()
	{

		$model = new Modelpihaktravel();

		$tombolcari = $this->request->getPost('tombolcari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_rute', $cari);
			redirect()->to('Pihaktravel/index');
		} else {
			$cari = session()->get('cari_rute');
		}

		$datarute = $cari ? $model->cariData($cari)->paginate(10, 'rute') : $model->tampildata()->paginate(10, 'rute');


		$data = [
			'tampildata' => $datarute,

			'cari' => $cari
		];
		return view('pihaktravel/viewpihaktravel', $data);
	}

	public function simpandata()
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
			return redirect()->to('Pihaktravel/index');
		}
	}

	public function hapus()
	{

		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');


			$Modelpihaktravel = new Modelpihaktravel();

			$Modelpihaktravel->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	public function formtambah()
	{

		return view('pihaktravel/formtambah');
	}



	public function viewdata()
	{

		//data pesanan seaya
		$tombolcari = $this->request->getPost('tombolcari');

		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_faktur', $cari);
			redirect()->to('/transaksi/data');
		} else {
			$cari = session()->get('cari_faktur');
		}

		$Modeltaransaksi = new Modeltaransaksi();

		$totaldata = $cari ? $Modeltaransaksi->tampildata_cari($cari)->countAllResults() : $Modeltaransaksi->tampildata()->countAllResults();

		$databarangkeluar = $cari ? $Modeltaransaksi->tampildata_cari($cari)->OrderBy('faktur', 'desc')->paginate(1000, 'transaksi') : $Modeltaransaksi->tampildata()->OrderBy('faktur', 'desc')->paginate(1000, 'transaksi');
		$nohalaman = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

		$data = [
			'tampildata' => $databarangkeluar,
			'pager' => $Modeltaransaksi->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,
			'cari' => $cari

		];

		return view('pihaktravel/viewpesanansaya', $data);
	}

	public function viewbiayalayanan()
	{

		//data pesanan seaya
		$tombolcari = $this->request->getPost('tombolcari');

		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_faktur', $cari);
			redirect()->to('/transaksi/data');
		} else {
			$cari = session()->get('cari_faktur');
		}

		$Modeltaransaksi = new Modelbiayalayanan();

		$totaldata = $cari ? $Modeltaransaksi->tampildata_cari($cari)->countAllResults() : $Modeltaransaksi->tampildata()->countAllResults();

		$databarangkeluar = $cari ? $Modeltaransaksi->tampildata_cari($cari)->OrderBy('faktur', 'desc')->paginate(1000, 'transaksi') : $Modeltaransaksi->tampildata()->OrderBy('faktur', 'desc')->paginate(1000, 'transaksi');
		$nohalaman = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

		$data = [
			'tampildata' => $databarangkeluar,
			'pager' => $Modeltaransaksi->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,
			'cari' => $cari

		];

		return view('pihaktravel/viewbiayalayanan', $data);
	}

	public function batalkan()
	{

		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('id');
			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => 'Pesanan Dibatalkan'


			]);
			$json = [
				'sukses' => 'Pesanan Berhasil Dibatalkan'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function terima()
	{

		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('id');
			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => 'Pesanan Diterima'


			]);
			$json = [
				'sukses' => 'Pesanan Berhasil Diterima'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	public function jemput()
	{

		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('id');
			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => 'Penumpang Dijemput'


			]);
			$json = [
				'sukses' => 'Penumpang Berhasil Dijemput'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function antar()
	{

		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('id');
			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => 'Penumpang Diantar'


			]);
			$json = [
				'sukses' => 'Penumpang Berhasil Diantar'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function selesai()
	{

		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('id');
			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => 'Pesanan Selesai'


			]);
			$json = [
				'sukses' => 'Pesanan Selesai'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	public function buatfaktur()
	{
		$tanggalSekarang = date('Y-m-d');
		$Modeltaransaksi = new Modeltaransaksi();

		$hasil = $Modeltaransaksi->nofaktur($tanggalSekarang)->getRowArray();
		$data = $hasil['nofaktur'];

		$noUrutTerakhir = substr($data, -4);
		//nomor urut ditambah 1
		$nomorUrutSelanjutnya = intval($noUrutTerakhir) + 1;
		//membuat format nomor transaksi berikutnya
		$noFaktur = sprintf('TRK-') . date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nomorUrutSelanjutnya);
		return $noFaktur;
	}
}