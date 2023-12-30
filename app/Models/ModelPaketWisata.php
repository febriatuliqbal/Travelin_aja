<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPaketWisata extends Model
{
	protected $table                = 'paketw';
	protected $primaryKey           = 'idpaketwisata';
	protected $allowedFields       = ['idpaketwisata', 'namapaket', 'harga'];

	public function tampildata()
	{
		return $this->table('paketw');
	}

	public function tampildata_cari($cari)
	{
		return $this->table('paketw')->like('namapaket', $cari);
	}
}