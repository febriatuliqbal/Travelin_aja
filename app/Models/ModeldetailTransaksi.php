<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeldetailTransaksi extends Model
{
	protected $table                = 'detailtransaksi';
	protected $primaryKey           = 'iddetail';
	protected $allowedFields       = ['iddetail', 'detfaktur',  'detpaket', 'detjeniscucian','det_harga','detharga_tambahan', 'detberat_jumlah', 'dettotalharga'];



	public function dataDetail($faktur)
	{
		return $this->table('detailtransaksi')->join('jeniscucian', 'detjeniscucian=kdjeniscucian')->where('sha1(detfaktur)', $faktur)->get();
	}

	
	public function dataDetailuntukcetak($faktur)
	{
		return $this->table('detailtransaksi')->join('jeniscucian', 'detjeniscucian=kdjeniscucian')->where('detfaktur', $faktur)->get();
	}

	public function tampildatatemp($faktur)
	{
		return $this->table('detailtransaksi')->join('jeniscucian', 'kdjeniscucian=detjeniscucian')->where(['detfaktur' => $faktur])->get();
	}

	public function hapusData($nofaktur)
	{
		$this->table('detailtransaksi')->where('detfaktur', $nofaktur);
		return $this->table('detailtransaksi')->delete();
	}

	public function ambilTotalHarga($faktur)
	{
		$query = $this->table('detailtransaksi')->getWhere([
			'detfaktur' => $faktur
		]);
		$totalharga = 0;
		foreach ($query->getResultArray() as $r) {
			$totalharga += $r['dettotalharga'];
		}
		return $totalharga;
	}

	public function ambildetailberdasarkanid($iddetail)
	{
		return $this->table('detailtransaksi')->join('jeniscucian', 'kdjeniscucian=detjeniscucian')->where('iddetail', $iddetail)->get();
	}

	public function laporanperperiode($tglawal,$tglakhir){
				
		return $this->table('detailtransaksi')->join('transaksilaundry', 'faktur=detfaktur')->join('jeniscucian', 'kdjeniscucian=detjeniscucian')->where('tgl>=',$tglawal)->where('tgl<=',$tglakhir)->get();
	}

	

}
