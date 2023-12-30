<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelulasan extends Model
{
	protected $table                = 'ulasanrute';
	protected $primaryKey           = 'idrute';
	protected $allowedFields       = ['idrute', 'ulasan', 'nama', 'nilai'];

	public function cariData($cari)
	{
		return $this->table('ulasanrute')->like('idrute', $cari);
	}

	public function tampildata()
	{
		return $this->table('idulasan');
	}

	public function ratarata($id)
	{
		return $this->table('ulasanrute')->select_avg('tinggi_badan')->where(['idrute' => $id]);
	}
}