<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelpihaktravel extends Model
{
	protected $table                = 'pihaktravel';
	protected $primaryKey           = 'idpihaktravel';
	protected $allowedFields       = ['idpihaktravel', 'idlevel', 'password', 'namapihaktravel', 'alamatpihaktravel', 'telppihaktravel'];

	public function cariData($cari)
	{
		return $this->table('pihaktravel')->like('namapihaktravel', $cari);
	}

	public function tampildata()
	{
		return $this->table('pihaktravel');
	}
}