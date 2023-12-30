<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modeldatataransaksi;
use App\Models\ModeldetailTransaksi;
use App\Models\ModelPaketWisata;
use App\Models\ModelRute;
use App\Models\ModelPaketWisataWisata;
use App\Models\Modelpelanggan;
use App\Models\Modeltemptransaksi;
use App\Models\Modeltaransaksi;
use CodeIgniter\HTTP\Request;
use config\Services;





class Transaksi extends BaseController
{
	public function index()
	{

		$Modelpelanggan = new Modelpelanggan();
		$ModelRute = new ModelRute();
		$ModelPaketWisata = new ModelPaketWisata();

		$data = [
			'datakategori' => $Modelpelanggan->findAll(),
			'datarute' => $ModelRute->findAll(),
			'datapeket' => $ModelPaketWisata->findAll(),
			'nofaktur' => $this->buatfaktur()
		];


		return view('transaksi/forminput', $data);
	}

	public function viewdata()
	{
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

		$databarangkeluar = $cari ? $Modeltaransaksi->tampildata_cari($cari)->paginate(10, 'transaksi') : $Modeltaransaksi->tampildata()->paginate(10, 'transaksi');

		$nohalaman = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;

		$data = [
			'tampildata' => $databarangkeluar,
			'pager' => $Modeltaransaksi->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,
			'cari' => $cari

		];

		return view('transaksi/viewdata', $data);
	}

	public function listDatatransaksi()
	{
		//parameter
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');

		$request = Services::request();
		$datamodel = new Modeldatataransaksi($request);
		if ($request->getMethod(true) == 'POST') {
			$lists = $datamodel->get_datatables($tglawal, $tglakhir);
			$data = [];
			$no = $request->getPost("start");
			foreach ($lists as $list) {
				$no++;
				$row = [];


				$tombolcetak =  "<center><button type=\"button\" class=\"btn  btn-sm btn-info\" onclick=\"cetak('" . $list->faktur . "')\"><i class=\"fa fa-print\"></i></button>";
				$tomboledit = "<button type=\"button\" class=\"btn  btn-sm btn-primary\" onclick=\"edit('" .  sha1($list->faktur) . "')\"><i class=\"fa fa-edit\"></i></button>";
				$iconhapus = '<i class="fa fa-trash-alt"></i>';
				$tombolhapus = "<button type=\"button\" class=\"btn  btn-sm btn-danger\" onclick=\"HapusTransaksi('" . sha1($list->faktur) . "')\">$iconhapus</button> ";
				$tombolubahstatus = "<button type=\"button\" class=\"btn  btn-sm btn-info\" onclick=\"ubah('" . sha1($list->faktur) . "')\">UBAH STATUS</button>";


				//isi tabel
				$row[] =  "<center>" . $no;
				$row[] =  "<center>" . $list->faktur;
				$row[] =  "<center>" . $list->tgl;
				$row[] = "<center>" . $list->namapelanggan;
				$row[] = "<center>" . $list->asal_tujuan;
				$row[] = "<center>" . $list->namapaket;
				$row[] =  "<center>" . "Rp. " . number_format($list->total, 0, ",", ".");
				$row[] =  "<center>" . $list->status;
				$row[] =  $tombolcetak . "  " . $tombolhapus . "    " . $tombolubahstatus;
				$data[] = $row;
			}
			$output = [
				"draw" => $request->getPost('draw'),
				"recordsTotal" => $datamodel->count_all($tglawal, $tglakhir),
				"recordsFiltered" => $datamodel->count_filtered($tglawal, $tglakhir),
				"data" => $data
			];
			echo json_encode($output);
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

		$modelTemp = new Modeltemptransaksi();
		$dataTemp = $modelTemp->getWhere(['detfaktur' => $noFaktur]);



		$json = [
			'nofaktur' => $noFaktur,
			'detpaket' => $dataTemp

		];
		echo json_encode($json);
	}

	function dataTemp()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$modelTemp = new Modeltemptransaksi();
			$dataTemp = $modelTemp->getWhere(['detfaktur' => $faktur]);

			$totalSubtotal = 0;
			$paket = 0;
			foreach ($dataTemp->getResultArray() as $total) :
				$totalSubtotal += intval($total['dettotalharga']);
				$paket = intval($total['detpaket']);
			endforeach;


			$data = [
				'datatemp' => $modelTemp->tampildatatemp($faktur),
				'total' => $totalSubtotal,


			];
			$json = [
				'data' => view('transaksi/datatemp', $data),
				'paket' => $paket

			];


			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
	function ambilhargapaket()
	{
		if ($this->request->isAJAX()) {

			$idpaketwisata = $this->request->getPost('idpaketwisata');
			$ModelPaketWisata = new ModelPaketWisata();
			$ambilData = $ModelPaketWisata->find($idpaketwisata);

			if ($ambilData == NULL) {
				$json = [
					'error' => 'PERIKSA KODE BARANG ANDA , PASTIKAN KODE BARANG SUDAH BETUL/TERDAFTAR'
				];
			} else {

				$data = [
					'hargapaket' => $ambilData['harga'],

				];
				$json = [
					'sukses' => $data
				];
			}
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}



	function ambilhargajenispakaian()
	{
		if ($this->request->isAJAX()) {

			$kdpaket = $this->request->getPost('jeniscucian');
			$ModelRute = new ModelRute();
			$ambilData = $ModelRute->find($kdpaket);

			if ($ambilData == NULL) {
				$json = [
					'error' => 'PERIKSA KODE BARANG ANDA , PASTIKAN KODE BARANG SUDAH BETUL/TERDAFTAR'
				];
			} else {

				$data = [
					'harga' => $ambilData['harga'],

				];
				$json = [
					'sukses' => $data
				];
			}
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
	function ambilDataBarang()
	{
		if ($this->request->isAJAX()) {

			$kodebarang = $this->request->getPost('kodebarang');
			$ModelPaketWisata = new ModelPaketWisata();
			$ambilData = $ModelPaketWisata->find($kodebarang);

			if ($ambilData == NULL) {
				$json = [
					'error' => 'PERIKSA KODE BARANG ANDA , PASTIKAN KODE BARANG SUDAH BETUL/TERDAFTAR'
				];
			} else {

				$data = [
					'namabarang' => $ambilData['brgnama1910005'],
					'hargajual' => $ambilData['brgharga1910005']

				];
				$json = [
					'sukses' => $data
				];
			}
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function simpanTemp()
	{

		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$paket = $this->request->getPost('paket');
			$jeniscucian = $this->request->getPost('jeniscucian');
			$hargapaket = $this->request->getPost('hargapaket');
			$realhargacucian = $this->request->getPost('realhargacucian');
			$berat = $this->request->getPost('berat');

			$Modeltemptransaksi = new Modeltemptransaksi();

			$Modeltemptransaksi->insert([
				'detfaktur' => $faktur,
				'detpaket' => $paket,
				'detjeniscucian' => $jeniscucian,
				'det_harga' => $realhargacucian,
				'detharga_tambahan' => $hargapaket,
				'detberat_jumlah' => $berat,
				'dettotalharga' => (doubleval($realhargacucian) + doubleval($hargapaket)) * doubleval($berat),
			]);


			$json = [
				'sukses' => 'ITEM BERHASIL DITAMBAHKAN'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}




	function hapus()
	{
		if ($this->request->isAJAX()) {
			$id = $this->request->getPost('id');

			$Modeltemptransaksi = new Modeltemptransaksi();
			$Modeltemptransaksi->delete($id);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function simpandetail()
	{

		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$paket = $this->request->getPost('paket');
			$jeniscucian = $this->request->getPost('jeniscucian');
			$hargapaket = $this->request->getPost('hargapaket');
			$realhargacucian = $this->request->getPost('realhargacucian');
			$berat = $this->request->getPost('berat');

			$ModeldetailTransaksi = new ModeldetailTransaksi();

			$ModeldetailTransaksi->insert([
				'detfaktur' => $faktur,
				'detpaket' => $paket,
				'detjeniscucian' => $jeniscucian,
				'det_harga' => $realhargacucian,
				'detharga_tambahan' => $hargapaket,
				'detberat_jumlah' => $berat,
				'dettotalharga' => (doubleval($realhargacucian) + doubleval($hargapaket)) * doubleval($berat),
			]);

			//meperbarui total harga

			$Modeltaransaksi = new Modeltaransaksi();
			$ambiltotalharga = $ModeldetailTransaksi->ambilTotalHarga($faktur);

			$Modeltaransaksi->update($faktur, [
				'total' => $ambiltotalharga
			]);


			$json = [
				'sukses' => 'ITEM BERHASIL DITAMBAHKAN'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}
	function updatedetail()
	{

		if ($this->request->isAJAX()) {


			$iddetail = $this->request->getPost('id');
			$faktur = $this->request->getPost('faktur');
			$paket = $this->request->getPost('paket');
			$jeniscucian = $this->request->getPost('jeniscucian');
			$hargapaket = $this->request->getPost('hargapaket');
			$realhargacucian = $this->request->getPost('realhargacucian');
			$berat = $this->request->getPost('berat');

			$ModeldetailTransaksi = new ModeldetailTransaksi();

			$ModeldetailTransaksi->update($iddetail, [
				'detpaket' => $paket,
				'detjeniscucian' => $jeniscucian,
				'det_harga' => $realhargacucian,
				'detharga_tambahan' => $hargapaket,
				'detberat_jumlah' => $berat,
				'dettotalharga' => (doubleval($realhargacucian) + doubleval($hargapaket)) * doubleval($berat),
			]);

			//meperbarui total harga

			$Modeltaransaksi = new Modeltaransaksi();
			$ambiltotalharga = $ModeldetailTransaksi->ambilTotalHarga($faktur);

			$Modeltaransaksi->update($faktur, [
				'total' => $ambiltotalharga
			]);


			$json = [
				'sukses' => 'ITEM BERHASIL DITAMBAHKAN'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	function hapusdatadetail()
	{
		if ($this->request->isAJAX()) {

			$id = $this->request->getPost('id');
			$faktur = $this->request->getPost('id');

			$ModeldetailTransaksi = new ModeldetailTransaksi();
			$Modeltaransaksi = new Modeltaransaksi();
			$ModeldetailTransaksi->delete($id);


			//meperbarui total harga

			$Modeltaransaksi = new Modeltaransaksi();
			$ambiltotalharga = $ModeldetailTransaksi->ambilTotalHarga($faktur);

			$Modeltaransaksi->update($faktur, [
				'total' => $ambiltotalharga
			]);

			$json = [
				'sukses' => 'Item Berhasil Terhapus'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	//cari barang dari forminput langsung
	function cariDataBarang()
	{
		if ($this->request->isAJAX()) {

			$cari = $this->request->getPost('cari');
			$modalBarang = new Modelpelanggan();
			$data = $modalBarang->tampildata_cari($cari)->get();

			$json = [
				'data' => view('transaksi/modalcaribarang', ['tampildata' => $data])

			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	//cari barang dari dengan popup
	// function cariDataBarang()
	// {
	// 	if ($this->request->isAJAX()) {

	// 		$json = [
	// 			'data' => view('transaksi/modalcaribarang')

	// 		];
	// 		echo json_encode($json);
	// 	} else {
	// 		exit('MAAF TIDAK BISA DI PANGGIL');
	// 	}
	// }



	function detailCariBarang()
	{
		if ($this->request->isAJAX()) {

			$cari = $this->request->getPost('cari');
			$Modelpelanggan = new Modelpelanggan();
			$data = $Modelpelanggan->tampildata_cari($cari)->get();

			$json = [
				'data' => view('transaksi/detaidatabarang', ['tampildata' => $data])

			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function selesaiTransaksi()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$tgl = $this->request->getPost('tglfaktur');
			$idpelanggan = $this->request->getPost('idpelanggan');
			$totalharga = $this->request->getPost('totalharga');
			$idpaket = $this->request->getPost('idpaket');



			$data = [
				'faktur' => $faktur,
				'tgl' => $tgl,
				'idpelanggan' => $idpelanggan,
				'totalharga' => $totalharga,
				'idpaket' => $idpaket,

			];

			$json = [
				'data' => view('transaksi/modalpembayaran', $data)
			];


			//koding transaksi langsung di simpan tanpa cetak faktur
			// //simpan datA ke tambel barang masuk
			// $ModelPaketWisatakeluar = new ModelPaketWisatakeluar();
			// $totalSubtotal = 0;
			// foreach ($dataTemp->getResultArray() as $total) :
			// 	$totalSubtotal += intval($total['detsubtotal1910005']);
			// endforeach;

			// $ModelPaketWisatakeluar->insert([
			// 	'faktur' => $faktur,
			// 	'tgl' => $tgl,
			// 	'idpel1910005' => $idpelanggan,
			// 	'total' => $totalSubtotal
			// ]);

			// //simpam ke tabel detailbarang masuk yang datanya di ambil dari tempbarangasuk
			// $ModelDetailBarangKeluar = new ModelDetailBarangKeluar();
			// foreach ($dataTemp->getResultArray() as $row) :
			// 	$ModelDetailBarangKeluar->insert([
			// 		'detfaktur' => $row['detfaktur'],
			// 		'detbrgkode1910005' => $row['detbrgkode1910005'],
			// 		'dethargajual1910005' => $row['dethargajual1910005'],
			// 		'detjml1910005' => $row['detjml1910005'],
			// 		'detsubtotal1910005' => $row['detsubtotal1910005']

			// 	]);
			// endforeach;

			// //hapus data di tabel temp
			// $modelTemp->emptyTable();

			// $json = [
			// 	'sukses' => 'Transaksi berhasil disimpan'
			// ];



			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function selesaieditTransaksi()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$tgl = $this->request->getPost('tglfaktur');
			$idpelanggan = $this->request->getPost('idpelanggan');
			$totalharga = $this->request->getPost('totalharga');
			$idpaket = $this->request->getPost('idpaket');


			$modeldatail = new ModeldetailTransaksi();
			$datadetail = $modeldatail->getWhere(['detfaktur' => $faktur]);

			if ($datadetail->getNumRows() == 0) {
				//jika item belum di input
				$json = [
					'error' => 'Maaf data item untuk faktur ini belum ada'
				];
			} else {

				$data = [

					'faktur' => $faktur,
					'tgl' => $tgl,
					'idpelanggan' => $idpelanggan,
					'totalharga' => $totalharga,
					'idpaket' => $idpaket,

				];

				$json = [
					'data' => view('transaksi/modalpembayaran2', $data)
				];


				//koding transaksi langsung di simpan tanpa cetak faktur
				// //simpan datA ke tambel barang masuk
				// $ModelPaketWisatakeluar = new ModelPaketWisatakeluar();
				// $totalSubtotal = 0;
				// foreach ($dataTemp->getResultArray() as $total) :
				// 	$totalSubtotal += intval($total['detsubtotal1910005']);
				// endforeach;

				// $ModelPaketWisatakeluar->insert([
				// 	'faktur' => $faktur,
				// 	'tgl' => $tgl,
				// 	'idpel1910005' => $idpelanggan,
				// 	'total' => $totalSubtotal
				// ]);

				// //simpam ke tabel detailbarang masuk yang datanya di ambil dari tempbarangasuk
				// $ModelDetailBarangKeluar = new ModelDetailBarangKeluar();
				// foreach ($dataTemp->getResultArray() as $row) :
				// 	$ModelDetailBarangKeluar->insert([
				// 		'detfaktur' => $row['detfaktur'],
				// 		'detbrgkode1910005' => $row['detbrgkode1910005'],
				// 		'dethargajual1910005' => $row['dethargajual1910005'],
				// 		'detjml1910005' => $row['detjml1910005'],
				// 		'detsubtotal1910005' => $row['detsubtotal1910005']

				// 	]);
				// endforeach;

				// //hapus data di tabel temp
				// $modelTemp->emptyTable();

				// $json = [
				// 	'sukses' => 'Transaksi berhasil disimpan'
				// ];
			}


			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function selesaieditTransaksistatus()
	{
		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('faktur');
			$status = $this->request->getPost('status');




			//menyimpang ke table TRANSAKSI
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'status' => $status


			]);


			$json = [
				'sukses' => 'Transaksi berhasil diubah statusnya',

			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	function simpanPembayaran()
	{
		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('nofaktur');
			$tanggalfaktur = $this->request->getPost('tanggalfaktur');
			$idpelanggan = $this->request->getPost('idpelanggan');
			$idpaket = $this->request->getPost('idpaket2');


			// mengubah tanda titik di total bayar, jumlah uang dan sisa
			$totalbayar = str_replace(".", "", $this->request->getPost('totalbayar'));
			$jumalhuang = str_replace(".", "", $this->request->getPost('jumalhuang'));
			$sisauang = str_replace(".", "", $this->request->getPost('sisauang'));

			//menyimpang ke table barangkeluar
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->insert([
				'faktur' => $nofaktur,
				'tgl' => $tanggalfaktur,
				'idpelanggan' => $idpelanggan,
				'total' => $totalbayar,
				'idrutetransakasi' => $idpaket,
				'jumlahuang' => $jumalhuang,
				'sisuang' => $sisauang,
				'status' => "LUNAS",


			]);




			$json = [
				'sukses' => 'TRANSAKSI BERHASIL DISIMPAN',
				'cetakfaktur' => site_url('transaksi/cetakfaktur/' . $nofaktur)

			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function simpanPembayaranDiedit()
	{
		if ($this->request->isAJAX()) {

			$nofaktur = $this->request->getPost('nofaktur');
			$tanggalfaktur = $this->request->getPost('tanggalfaktur');
			$idpelanggan = $this->request->getPost('idpelanggan');
			$idpaket = $this->request->getPost('idpaket2');

			// mengubah tanda titik di total bayar, jumlah uang dan sisa
			$totalbayar = str_replace(".", "", $this->request->getPost('totalbayar'));
			$jumalhuang = str_replace(".", "", $this->request->getPost('jumalhuang'));
			$sisauang = str_replace(".", "", $this->request->getPost('sisauang'));

			//menyimpang ke table barangkeluar
			$Modeltaransaksi = new Modeltaransaksi();
			$Modeltaransaksi->update($nofaktur, [
				'tgl' => $tanggalfaktur,
				'idpel' => $idpelanggan,
				'total' => $totalbayar,
				'jumlahuang' => $jumalhuang,
				'sisuang' => $sisauang,
				'idpak' => $idpaket,

			]);


			$json = [
				'sukses' => 'Transaksi berhasil disimpan',
				'cetakfaktur' => site_url('transaksi/cetakfaktur/' . $nofaktur)

			];

			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function validasi_faktur_transaksi()
	{

		//ini adalah validasi ketika memsukan nomor faktur, apakah nomornya sudah tersimpan di barang masuk
		if ($this->request->isAJAX()) {

			$kodebarang = $this->request->getPost('faktur');
			$ModelPaketWisata = new Modeltemptransaksi();
			$ambilData = $ModelPaketWisata->find($kodebarang);

			if ($ambilData == NULL) {

				$json = [
					'sukses' => 'NO FAKTUR BISA DI GUNANKAN'
				];
			} else {

				$json = [
					'error' => 'KARENA TRANSAKSI DENGAN NOMOR FAKTUR INI SUDAH DISIMPAN'
				];
			}
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	public function data()
	{
		$tombolcari = $this->request->getPost('tombolcari');

		if (isset($tombolcari)) {
			$cari = $this->request->getPost('cari');
			session()->set('cari_faktur', $cari);
			redirect()->to('/transaksi/data');
		} else {
			$cari = session()->get('cari_faktur');
		}

		$Modeltaransaksi = new Modeltemptransaksi();

		$totaldata = $cari ? $Modeltaransaksi->tampildata_cari($cari)->countAllResults() : $Modeltaransaksi->countAllResults();

		$datatransaksi = $cari ? $Modeltaransaksi->tampildata_cari($cari)->paginate(10, 'transaksi') : $Modeltaransaksi->paginate(10, 'transaksi');

		$nohalaman = $this->request->getVar('page_transaksi') ? $this->request->getVar('page_transaksi') : 1;
		$faktur = ('F001');
		$data = [
			'datatemp' => $Modeltaransaksi->tampildatatemp($faktur),
			'tampildata' => $datatransaksi,
			'pager' => $Modeltaransaksi->pager,
			'nohalaman' => $nohalaman,
			'totaldata' => $totaldata,
			'cari' => $cari

		];

		return view('transaksi/datatemp', $data);
	}

	function DetailItem()
	{
		if ($this->request->isAJAX()) {
			$faktur = $this->request->getPost('faktur');
			$modeldatail = new ModeldetailTransaksi();

			$data = [
				'tampildatadetail' => $modeldatail->dataDetail($faktur)
			];

			$json = [
				'data' => view('transaksi/modeldatailitem', $data)
			];


			echo json_encode($json);
		}
	}

	function edit($faktur)
	{
		$Modeltaransaksi = new Modeltaransaksi();
		$Modelpelanggan = new Modelpelanggan();
		$ModelRute = new ModelRute();
		$ModelPaketWisata = new ModelPaketWisata();
		$cekfaktur = $Modeltaransaksi->cekFaktur($faktur);




		if ($cekfaktur->getNumRows() > 0) {
			$row = $cekfaktur->getRowArray();

			$data = [

				'nofaktur' => $row['faktur'],
				'tanggal' => $row['tgl'],
				'idpel' => $row['idpel'],

				'namapel' => $row['namapelanggan'],
				'nohp' => $row['hppelanggan'],


				'datakategori' => $Modelpelanggan->findAll(),
				'datajeniscucian' => $ModelRute->findAll(),
				'datapeket' => $ModelPaketWisata->findAll(),

			];

			return view('transaksi/fomredit', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}

	function editstatus($faktur)
	{
		$Modeltaransaksi = new Modeltaransaksi();
		$Modelpelanggan = new Modelpelanggan();
		$ModelRute = new ModelRute();
		$ModelPaketWisata = new ModelPaketWisata();
		$cekfaktur = $Modeltaransaksi->cekFaktur($faktur);




		if ($cekfaktur->getNumRows() > 0) {
			$row = $cekfaktur->getRowArray();

			$data = [

				'nofaktur' => $row['faktur'],
				'tanggal' => $row['tgl'],
				'idpel' => $row['idpelanggan'],
				'status' => $row['status'],

				'namapel' => $row['namapelanggan'],
				'nohp' => $row['hppelanggan'],


				'datakategori' => $Modelpelanggan->findAll(),
				'datajeniscucian' => $ModelRute->findAll(),
				'datapeket' => $ModelPaketWisata->findAll(),

			];

			return view('transaksi/fomreditstatus', $data);
		} else {
			exit('DATA TIDAK DITEMUKAN');
		}
	}




	function datadetail()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$modelTemp = new ModeldetailTransaksi();
			$dataTemp = $modelTemp->getWhere(['detfaktur' => $faktur]);

			$totalSubtotal = 0;
			$paket = 0;
			foreach ($dataTemp->getResultArray() as $total) :
				$totalSubtotal += intval($total['dettotalharga']);
				$paket = intval($total['detpaket']);
			endforeach;


			$data = [
				'datatemp' => $modelTemp->tampildatatemp($faktur),
				'total' => $totalSubtotal,


			];
			$json = [
				'data' => view('transaksi/datadetail', $data),
				'paket' => $paket

			];


			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function datadetailstatus()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$modelTemp = new ModeldetailTransaksi();
			$dataTemp = $modelTemp->getWhere(['detfaktur' => $faktur]);

			$totalSubtotal = 0;
			$paket = 0;
			foreach ($dataTemp->getResultArray() as $total) :
				$totalSubtotal += intval($total['dettotalharga']);
				$paket = intval($total['detpaket']);
			endforeach;


			$data = [
				'datatemp' => $modelTemp->tampildatatemp($faktur),
				'total' => $totalSubtotal,


			];
			$json = [
				'data' => view('transaksi/datadetailstatus', $data),
				'paket' => $paket

			];


			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}

	function editItem()
	{
		if ($this->request->isAJAX()) {
			$iddetail = $this->request->getPost('iddetail');

			$modeldetail = new ModeldetailTransaksi();
			$ambilData = $modeldetail->ambildetailberdasarkanid($iddetail);

			$row = $ambilData->getRowArray();

			$data = [
				'iddetail' => $row['iddetail'],
				'jeniscucian' => $row['detjeniscucian'],
				'det_harga' => $row['det_harga'],
				'berat' => $row['detberat_jumlah'],

			];

			$json = [
				'sukses' => $data
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	function updateitem()
	{
		if ($this->request->isAJAX()) {

			$faktur = $this->request->getPost('faktur');
			$hargajual = $this->request->getPost('hargajual');
			$hergabeli = $this->request->getPost('hergabeli');
			$jumlah = $this->request->getPost('jumlah');
			$iddetail = $this->request->getPost('iddetail');

			$modeldatail = new modeldetailtransaksi();
			$Modeltaransaksi = new Modeltaransaksi();

			$modeldatail->update($iddetail, [

				'dethargajual1910005' => $hargajual,
				'dethargamasuk1910005' => $hergabeli,
				'detjml1910005' => $jumlah,
				'dettotalharga' => intval($jumlah) * intval($hergabeli)
			]);

			$ambiltotalharga = $modeldatail->ambilTotalHarga($faktur);

			$Modeltaransaksi->update($faktur, [
				'total' => $ambiltotalharga
			]);



			$json = [
				'sukses' => 'ITEM BERHASIL DITAMBAHKAN'
			];
			echo json_encode($json);
		} else {
			exit('MAAF TIDAK BISA DI PANGGIL');
		}
	}


	public function hapusTransaksi()
	{

		$faktur = $this->request->getPost('faktur');

		$db = \Config\Database::connect();

		$Modeltaransaksi = new Modeltaransaksi();



		$db->table('transaksitravel')->delete(['sha1(faktur)' => $faktur]);




		$json = [
			'sukses' => "TRANSAKSI DENGAN KODE : $faktur , BERHASIL DIHAPUS"
		];
		echo json_encode($json);
	}

	public function cetakfaktur($faktur)
	{
		$Modeltaransaksi = new Modeltaransaksi();

		$modelpelanggan = new ModelPelanggan();
		$ModelPaketWisata = new ModelRute();

		$cekdata = $Modeltaransaksi->find($faktur);
		$datapelanggan = $modelpelanggan->find($cekdata['idpelanggan']);
		$namapelanggan = ($datapelanggan != null) ? $datapelanggan['namapelanggan'] : '-';

		$datapaket = $ModelPaketWisata->find($cekdata['idrutetransakasi']);
		$namapaket =  $datapaket['asal_tujuan'];

		if ($cekdata != null) {

			$data = [
				'faktur' => $faktur,
				'tanggal' => $cekdata['tgl'],
				'namapelanggan' => $namapelanggan,
				'namapaket' => $namapaket,
				'jumlahuang' => $cekdata['jumlahuang'],
				'sisauang' => $cekdata['sisuang'],
				'total' => $cekdata['total'],

			];
			return view('transaksi/cetakfaktur', $data);
		} else {
			return redirect()->to(site_url('transaksi/index'));
		}
	}
}