<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRute extends Model
{
	protected $table                = 'rute';
	protected $primaryKey           = 'idrute';
	protected $allowedFields       = ['idrute', 'asal_tujuan', 'harga', 'jumlahpesanan', 'idtravel', 'totalpointulasan', 'jumlahulasan', 'mobil'];

	public function cariData($cari)
	{
		return $this->table('rute')->join('pihaktravel', 'idtravel=idpihaktravel')->like('asal_tujuan', $cari)->orlike('namapihaktravel', $cari);
	}

	public function tampildata()
	{
		return $this->table('rute')->join('pihaktravel', 'idtravel=idpihaktravel');
	}
}