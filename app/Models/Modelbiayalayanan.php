<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbiayalayanan extends Model
{
	protected $table                = 'biayalayanan';
	protected $primaryKey           = 'fakturlayanan';
	protected $allowedFields       = ['fakturlayanan', 'biayalayanan'];

	public function tampildata()
	{
		return $this->table('biayalayanan')->join('transaksitravel', 'fakturlayanan=faktur')->join('rute', 'idrute=idrutetransakasi')->join('pihaktravel', 'idpihaktravel=idtravel')->join('pelanggan', 'usenamepelanggan=idpelanggan');
	}

	public function tampildataberdasrakantgl($tglawal, $tglakhir)
	{
		return $this->table('transaksitravel')->join('pelanggan', 'usenamepelanggan=idpelanggan')->where('tgl>=', $tglawal)->where('tgl<=', $tglakhir)->get();;
	}

	public function tampildata_cari($cari)
	{
		return $this->table('biayalayanan')->join('transaksitravel', 'fakturlayanan=faktur')->join('rute', 'idrute=idrutetransakasi')->join('pelanggan', 'usenamepelanggan=idpelanggan')->orlike('faktur', $cari)->orlike('namapelanggan', $cari);;
	}


	public function cekFaktur($faktur)
	{
		return $this->table('transaksitravel')->join('pelanggan', 'usenamepelanggan=idpelanggan')->getWhere([
			'sha1(faktur)' => $faktur
		]);
	}
	public function noFaktur($tanggalSekarang)
	{
		return $this->table('transaksitravel')->select('max(faktur) as nofaktur')->where('tgl', $tanggalSekarang)->get();
		//select mas(faktur) as nofaktur from barangkeluar where tgl='';
	}

	public function laporanperperiode($tglawal, $tglakhir, $id)
	{
		return $this->table('biayalayanan')->join('transaksitravel', 'fakturlayanan=faktur')->join('pelanggan', 'usenamepelanggan=idpelanggan')->join('rute', 'idrute=idrutetransakasi')->join('pihaktravel', 'idpihaktravel=idtravel')->where('tgl>=', $tglawal)->where('tgl<=', $tglakhir)->where('idtravel=', $id)->get();
	}

	public function laporanperperiodeall($tglawal, $tglakhir)
	{
		return $this->table('biayalayanan')->join('transaksitravel', 'fakturlayanan=faktur')->join('pelanggan', 'usenamepelanggan=idpelanggan')->join('rute', 'idrute=idrutetransakasi')->join('pihaktravel', 'idpihaktravel=idtravel')->where('tgl>=', $tglawal)->where('tgl<=', $tglakhir)->get();
	}
}