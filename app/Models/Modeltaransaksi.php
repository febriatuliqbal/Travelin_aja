<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeltaransaksi extends Model
{
	protected $table                = 'transaksitravel';
	protected $primaryKey           = 'faktur';
	protected $allowedFields       = ['faktur', 'tgl', 'idpelanggan', 'idpaketw', 'idrutetransakasi', 'status', 'total', 'sisuang', 'jumlahuang', 'jam'];

	public function tampildata()
	{
		return $this->table('transaksitravel')->join('rute', 'idrute=idrutetransakasi')->join('pihaktravel', 'idpihaktravel=idtravel')->join('pelanggan', 'usenamepelanggan=idpelanggan');
	}

	public function tampildataberdasrakantgl($tglawal, $tglakhir)
	{
		return $this->table('transaksitravel')->join('pelanggan', 'usenamepelanggan=idpelanggan')->where('tgl>=', $tglawal)->where('tgl<=', $tglakhir)->get();;
	}

	public function tampildata_cari($cari)
	{
		return $this->table('transaksitravel')->join('rute', 'idrute=idrutetransakasi')->join('pelanggan', 'usenamepelanggan=idpelanggan')->orlike('faktur', $cari)->orlike('namapelanggan', $cari);;
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

	public function laporanperperiode($tglawal, $tglakhir)
	{
		return $this->table('transaksitravel')->join('pelanggan', 'usenamepelanggan=idpelanggan')->join('rute', 'idrute=idrutetransakasi')->join('pihaktravel', 'idpihaktravel=idtravel')->where('tgl>=', $tglawal)->where('tgl<=', $tglakhir)->get();
	}

	public function tampildatatemp($faktur)
	{
		return $this->table('transaksitravel')->join('pelanggan', 'usenamepelanggan=idpelanggan')->where(['idpelanggan' => $faktur])->get();
	}
}