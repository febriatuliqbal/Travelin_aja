<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;

class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     => CSRF::class,
		'toolbar'  => DebugToolbar::class,
		'honeypot' => Honeypot::class,
		//UNTUK MENFILER SATIAP LEVEL BEDA2 AKSES
		'filterAdmin' => \App\Filters\FilterAdmin::class,
		'Filterlevel2' => \App\Filters\Filterlevel2::class,
		'Filterlevel3' => \App\Filters\Filterlevel3::class,

	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			// 'honeypot',
			// 'csrf',
			//sebelum ada login hanya login yg bisa di kases
			'filterAdmin' => [
				'except' => ['login/*', 'login', '/', 'lamandepan/*', 'lamandepan', '/']
			],
			'Filterlevel2' => [
				'except' => ['login/*', 'login', '/', 'lamandepan/*', 'lamandepan', '/']
			],
			'Filterlevel3' => [
				'except' => ['login/*', 'login', '/', 'lamandepan/*', 'lamandepan', '/']
			]
		],
		'after'  => [
			'toolbar',
			// 'honeypot',
			//ini merupakan hile yg bisa di akses admin
			'filterAdmin' => [
				'except' => ['main/*', 'barang/*', 'transaksi/*', 'jam/*', 'jeniscucian/*', 'laporan/*', 'pelanggan/*', 'Rute/*', 'pelanggan2/*', 'Pihaktravel/*']
			],
			'Filterlevel2' => [
				'except' => ['main/*', 'transaksi/*', 'pelanggan2/*', 'Pihaktravel/*', 'Rute/*', 'jam/*', 'laporan/*']
			],
			'Filterlevel3' => [
				'except' => ['main/*', 'laporan/*']
			],
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	public $filters = [];
}