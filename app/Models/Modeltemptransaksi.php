<?php

namespace App\Models;

use CodeIgniter\Model;

class Modeltemptransaksi extends Model
{
	protected $table                = 'temptransaksi';
	protected $primaryKey           = 'iddetail';
	protected $allowedFields       = ['iddetail', 'detfaktur',  'detpaket', 'detjeniscucian', 'det_harga', 'detharga_tambahan', 'detberat_jumlah', 'dettotalharga'];



	public function tampildatatemp($faktur)
	{
		return $this->table('temptransaksi')->join('jeniscucian', 'kdjeniscucian=detjeniscucian')->where(['detfaktur' => $faktur])->get();
	}

	public function hapusData($nofaktur)
	{
		$this->table('temptransaksi')->where('detfaktur', $nofaktur);
		return $this->table('temptransaksi')->delete();
	}
}