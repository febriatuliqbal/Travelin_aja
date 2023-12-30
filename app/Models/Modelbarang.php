<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelbarang extends Model
{
	protected $table                = 'paket';
	protected $primaryKey           = 'kdpaket';
	protected $allowedFields       = ['kdpaket', 'namapaket', 'satuan', 'harga'];

	public function tampildata()
	{
		return $this->table('paket');
	}
	
	public function tampildata_cari($cari)
	{
		return $this->table('paket')->orlike('kdpaket', $cari)->orlike('namapaket', $cari);
	}
}
