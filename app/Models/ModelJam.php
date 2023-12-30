<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelJam extends Model
{
	protected $table                = 'jam';
	protected $primaryKey           = 'idjam';
	protected $allowedFields       = ['idjam', 'idrutejam', 'tgljam', 'namajam', 'bangku'];

	public function cariData($cari)
	{
		return $this->table('jam')->join('rute', 'idrute=idrutejam')->orlike('asal_tujuan', $cari);
	}

	public function tampildata()
	{

		return $this->table('jam')->join('rute', 'idrute=idrutejam');
	}
}