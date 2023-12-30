<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelLogin extends Model
{
	protected $table                = 'pengguna';
	protected $primaryKey           = 'pengid';
	protected $allowedFields       = ['pengid', 'pengnama', 'pengpass', 'penglevel'];
}