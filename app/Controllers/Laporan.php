<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Modelbiayalayanan;
use App\Models\Modeltaransaksi;
use App\Models\Modeldatataransaksi;
use App\Models\ModeldetailTransaksi;
use App\Models\ModelPaketWisata;
use App\Models\ModelRute;
use App\Models\ModelPaketWisataWisata;
use App\Models\Modelpelanggan;
use App\Models\Modelpihaktravel;
use App\Models\Modeltemptransaksi;


class Laporan extends BaseController
{
	public function index()
	{
		return view('laporan/index');
	}

	function cetakbarangmasuk()
	{
		return view('laporan/viewbarangmasuk');
	}

	function cetakbiayalayanan()
	{
		return view('laporan/viewbiayalayanan');
	}

	function cetakbiayalayananolehadmin()
	{

		$ModelTravel = new Modelpihaktravel();
		$data = [
			'datatravel' => $ModelTravel->findAll(),
		];

		return view('laporan/viewbiayalayananolehadmin', $data);
	}

	function cetakbiayalayananolehadminall()
	{



		return view('laporan/viewbiayalayananolehadminall');
	}



	function cetakbarangkeluar()
	{
		return view('laporan/viewbarangkeluar');
	}

	function cetakdetailbarangmasuk()
	{
		return view('laporan/viewdetailbarangmasuk');
	}

	function cetakdetailbarangkeluar()
	{
		return view('laporan/viewdetailbarangkeluar');
	}


	function cetakbarangmasukperiode()
	{
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');

		$modelbarangmasuk = new Modeltaransaksi();
		$datalaporan = $modelbarangmasuk->laporanperperiode($tglawal, $tglakhir);

		$data = [
			'datalaporan' => $datalaporan,
			'tglawal' => $tglawal,
			'tglakhir' => $tglakhir,

		];
		return view('laporan/cetallaporanbarangmasuk', $data);
	}

	function cetakbiayalayananperiode()
	{
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');
		$id = session()->iduser;


		$Modelbiayalayanan = new Modelbiayalayanan();
		$datalaporan = $Modelbiayalayanan->laporanperperiode($tglawal, $tglakhir, $id);

		$data = [
			'datalaporan' => $datalaporan,
			'tglawal' => $tglawal,
			'tglakhir' => $tglakhir,

		];
		return view('laporan/cetakbiayalayanan', $data);
	}


	function cetakbiayalayananperiodepertravel()
	{
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');
		$id =  $this->request->getPost('id');


		$Modelbiayalayanan = new Modelbiayalayanan();
		$datalaporan = $Modelbiayalayanan->laporanperperiode($tglawal, $tglakhir, $id);

		$data = [
			'datalaporan' => $datalaporan,
			'tglawal' => $tglawal,
			'tglakhir' => $tglakhir,

		];
		return view('laporan/cetakbiayalayananolehadmin', $data);
	}


	function cetakbiayalayananperiodepertravelall()
	{
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');



		$Modelbiayalayanan = new Modelbiayalayanan();
		$datalaporan = $Modelbiayalayanan->laporanperperiodeall($tglawal, $tglakhir);

		$data = [
			'datalaporan' => $datalaporan,
			'tglawal' => $tglawal,
			'tglakhir' => $tglakhir,

		];
		return view('laporan/cetakbiayalayananolehadminall', $data);
	}

	function cetakdetailbarangmasukperiode()
	{
		$tglawal = $this->request->getPost('tglawal');
		$tglakhir = $this->request->getPost('tglakhir');

		$modelbarangmasuk = new Modeltaransaksi();
		$modeldetail = new ModeldetailTransaksi();
		$datalaporan = $modelbarangmasuk->laporanperperiode($tglawal, $tglakhir);

		// foreach ($datalaporan->getResultArray() as $total) :			
		// 	$faktur = ($total['faktur1910005']);
		// 	$datadetail = $modeldetail->dataDetail($faktur);
		// endforeach;



		$data = [

			'datadetail' => $modeldetail->laporanperperiode($tglawal, $tglakhir),
			'datalaporan' => $datalaporan,
			'tglawal' => $tglawal,
			'tglakhir' => $tglakhir,

		];
		return view('laporan/cetaldetaillaporanbarangmasuk', $data);
	}
}