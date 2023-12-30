<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpelanggan extends Model
{
	protected $table                = 'pelanggan';
	protected $primaryKey           = 'usenamepelanggan';
	protected $allowedFields       = ['usenamepelanggan', 'namapelanggan', 'alamatpelannggan', 'hppelanggan', 'passwordpelanggan', 'userlevelid', 'poinpelanggan'];

	public function tampildata()
	{
		return $this->table('pelanggan');
	}

	public function tampildata_cari($cari)
	{
		return $this->table('pelanggan')->orlike('usenamepelanggan', $cari)->orlike('namapelanggan', $cari);
	}

	public function ambildataterkhirdiinput()
	{
		return $this->table('pelanggan')->limit(1)->orderBy('namapelanggan', 'DESC')->get();
	}
}