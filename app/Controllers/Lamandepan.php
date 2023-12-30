<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbiayalayanan;
use App\Models\ModelJam;
use App\Models\Modelpelanggan;
use App\Models\ModelRute;
use App\Models\Modeltaransaksi;
use App\Models\Modelulasan;

class Lamandepan extends BaseController
{
	public function index()
	{
		$ModelRute = new ModelRute();


		$data = [

			'datarute' => $ModelRute->tampildata()->OrderBy('jumlahpesanan', 'desc')->findAll(),

		];
		return view('lamandepan/home', $data);
	}

	public function konfirmasi()
	{

		return view('lamandepan/konfirmasi');
	}

	public function listrute()
	{
		// $ModelRute = new ModelRute();
		// $data = [

		// 	'datarute' => $ModelRute->tampildata()->OrderBy('jumlahpesanan', 'desc')->findAll(),

		// ];
		// return view('lamandepan/listrute', $data);



		$tombolcari = $this->request->getPost('cari');
		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_rute', $cari);
			redirect()->to('lamandepan/listrute');
		} else {
			$cari = session()->get('cari_rute');
		}

		$datarute = $cari ? $this->rute->cariData($cari)->OrderBy('jumlahpesanan', 'desc')->findAll() : $this->rute->tampildata()->OrderBy('jumlahpesanan', 'desc')->findAll();


		$data = [
			'datarute' => $datarute,


			'cari' => $cari
		];
		return view('lamandepan/listrute', $data);
	}

	public function pesanansaya()
	{


		$modelTemp = new Modeltaransaksi();

		$data = [
			'datapesanan' => $modelTemp->tampildata()->OrderBy('faktur', 'desc')->findAll(),

		];

		return view('lamandepan/pesanansaya', $data);
	}

	public function __construct()
	{
		$this->rute = new ModelRute();
		$this->jam = new ModelJam();
	}

	public function pemesanan($id)
	{

		$ModelRute = new ModelRute();
		$rowData = $this->rute->find($id);
		$Modeljam = new ModelJam();

		if ($rowData) {
			$data = [
				'datarute' => $ModelRute->findAll(),
				'idrute' => $id,
				'asal_tujuan' => $rowData['asal_tujuan'],
				'harga' => $rowData['harga'],
				'nofaktur' => $this->buatfaktur(),

				'datajam' => $Modeljam->findAll(),
			];
			return view('lamandepan/pemesanan', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}

	public function krimulasan($id)
	{
		$ModelRute = new ModelRute();
		$datarute = $ModelRute->find($id);

		$data = [
			'idrute' => $id,
			'asal_tujuan' => $datarute['asal_tujuan'],
		];
		return view('lamandepan/ulasan', $data);
	}


	public function simpanulasan()
	{


		if ($this->request->isAJAX()) {


			$idrute = $this->request->getPost('idrute');
			$ulasan = $this->request->getPost('ulasan');
			$nilai = $this->request->getPost('nilai');




			//menyimpang ke table barangkeluar
			$Modelulasan = new Modelulasan();
			$Modelulasan->insert([

				'idrute' => $idrute,
				'ulasan' => $ulasan,
				'nilai' => $nilai,
				'nama' => session()->namauser,


			]);

			// //koding tambah point ulasan
			$rute = new ModelRute();
			$cekrute = $rute->find($idrute);
			$pointawal = $cekrute['totalpointulasan'];
			$jumlahawal = $cekrute['jumlahulasan'];

			// penambahan point ulasan
			$pointakhir = intval($pointawal) + intval($nilai);
			$jumlahakhir = intval($jumlahawal) + 1;


			$modelrute = new ModelRute();
			$modelrute->update($idrute, [
				'totalpointulasan' => $pointakhir,
				'jumlahulasan' => $jumlahakhir,
			]);


			$json = [
				'sukses' => 'TRANSAKSI BERHASIL DISIMPAN',
				'idrute' => $idrute,
			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function viewulasan($id)
	{

		$Modelulasan = new Modelulasan();
		$modelrute = new ModelRute();
		$rowData = $modelrute->tampildata()->find($id);



		if ($rowData) {
			$data = [
				'id' => $id,
				'asal_tujuan' => $rowData['asal_tujuan'],
				'namapihaktravel' => $rowData['namapihaktravel'],
				'dataulasan' => $Modelulasan->findAll(),
			];
			return view('lamandepan/viewulasan', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}

	public function pilihjadwal()
	{





		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$tglfaktur = $this->request->getPost('tglfaktur');
			$idrute = $this->request->getPost('idrute');

			$ModelRute = new ModelRute();
			$rowData = $this->rute->find($idrute);

			$Modeljam = new ModelJam();


			if ($rowData) {
				$data = [
					'datarute' => $ModelRute->findAll(),
					'idrute' => $idrute,
					'asal_tujuan' => $rowData['asal_tujuan'],
					'harga' => $rowData['harga'],
					'nofaktur' => $faktur,
					'tglfaktur' => $tglfaktur,
					'datajam' => $Modeljam->findAll(),
				];
				return view('lamandepan/pilihjadwal', $data);
			} else {
				exit('DATA TIDAK DITEMUKAN');
			}
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

	public function buatnofaktur_jikatgldiubah()
	{
		$tanggalSekarang = $this->request->getPost('tanggal');
		$Modeltaransaksi = new Modeltaransaksi();

		$hasil = $Modeltaransaksi->nofaktur($tanggalSekarang)->getRowArray();
		$data = $hasil['nofaktur'];

		$noUrutTerakhir = substr($data, -4);
		//nomor urut ditambah 1
		$nomorUrutSelanjutnya = intval($noUrutTerakhir) + 1;
		//membuat format nomor transaksi berikutnya
		$noFaktur = sprintf('TRK-') . date('dmy', strtotime($tanggalSekarang)) . sprintf('%04s', $nomorUrutSelanjutnya);





		$json = [
			'nofaktur' => $noFaktur,


		];
		echo json_encode($json);
	}

	public function modaldatajam()
	{
		if ($this->request->isAJAX()) {

			$json = [
				'data' => view('lamandapan/modaldata')
			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	public function gunakanpoin()
	{




		$total = $this->request->getPost('total');
		$idpel = $this->request->getPost('idpel');

		//koding dapat poin
		$pelanggan = new Modelpelanggan();
		$cekpoint = $pelanggan->find($idpel);
		$pointawal = $cekpoint['poinpelanggan'];


		// point dari 10 persen total pesanan
		$hasil = intval($total) - intval($pointawal);


		$pelanggan->update($idpel, [
			'poinpelanggan' => '0',
		]);
		//koding untuk update sesion poin
		$simpan_sesion = [
			'poinpelanggan' => '0',

		];

		$json = [
			'hasilnya' => $hasil,


		];
		echo json_encode($json);
	}

	public function simpanpembayaran()
	{


		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$idpel = $this->request->getPost('idpel');
			$tglfaktur = $this->request->getPost('tglfaktur');
			$idrute = $this->request->getPost('idrute');
			$total = $this->request->getPost('total');
			$jam = $this->request->getPost('jam');


			//menyimpang ke table barangkeluar
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->insert([
				'faktur' => $faktur,
				'tgl' => $tglfaktur,
				'idpelanggan' => $idpel,
				'total' => $total,
				'idrutetransakasi' => $idrute,
				'jam' => $jam,
				'jumlahuang' => "0",
				'sisuang' => "0",
				'status' => "Pesanan Dikirim",


			]);
			//koding tambah jumpalh perjalanan
			$rute = new ModelRute();
			$cekrute = $rute->find($idrute);
			$jmlpesananawal = $cekrute['jumlahpesanan'];
			//point dari 10 persen total pesanan
			$jmlpesanan = intval($jmlpesananawal) + 1;
			//update point
			$rute->update($idrute, [
				'jumlahpesanan' => $jmlpesanan,
			]);

			//koding dapat poin
			$pelanggan = new Modelpelanggan();
			$cekpoint = $pelanggan->find($idpel);
			$pointawal = $cekpoint['poinpelanggan'];
			//point dari 10 persen total pesanan
			$point = intval($pointawal) + intval($total) * 0.1;
			//update point
			$pelanggan->update($idpel, [
				'poinpelanggan' => $point,
			]);
			//koding untuk update sesion poin
			$simpan_sesion = [

				'poinpelanggan' => $point,

			];


			session()->set($simpan_sesion);

			//simpan biaya layanan

			$biayalayanan = intval($total) * 0.2;
			$Modelbiayalayanan = new Modelbiayalayanan();
			$Modelbiayalayanan->insert([
				'fakturlayanan' => $faktur,
				'biayalayanan' => $biayalayanan,



			]);

			$json = [
				'sukses' => 'TRANSAKSI BERHASIL DISIMPAN',
			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function batalkan($id)
	{

		$Modeltaransaksi = new Modeltaransaksi();
		$nofaktur = $id;
		// $cekfaktur = $Modeltaransaksi->find($id);


		//menyimpang ke table TRANSAKSI
		$Modeltaransaksi = new Modeltaransaksi();
		$Modeltaransaksi->update($nofaktur, [
			'status' => 'Pesanan Dibatalkan'


		]);



		return redirect()->to('lamandepan/pesanansaya');
	}

	public function profil()
	{
		return view('lamandepan/profil');
	}

	public function updateprofil()
	{

		$pelanggan = new Modelpelanggan();
		$usenamepelanggan = $this->request->getPost('usenamepelanggan');
		$namapelanggan = $this->request->getPost('namapelanggan');
		$kategori = $this->request->getPost('alamat');
		$satuan = $this->request->getPost('nohp');


		// validasi
		$validation = \Config\Services::validation();

		$valid = $this->validate([

			'usenamepelanggan' => [
				'rules' => 'required',
				'label' => 'NAMA PELANGGAN',
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
				'label' => 'ALAMAT PELANGGAN',
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

			echo ($validation->listErrors());
		} else {


			$pelanggan->update($usenamepelanggan, [
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

			$simpan_sesion = [

				'namauser' => $namapelanggan,
				'alamatpelannggan' => $kategori,
				'hppelanggan' => $satuan,


			];

			session()->set($simpan_sesion);

			session()->setFlashdata($pesanSukses);
			return redirect()->to('lamandepan/profil');
		}
	}
}