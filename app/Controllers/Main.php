<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Main extends BaseController
{
	public function index()
	{
		return view('main/home');
		
	}

	//php spark serve --port 8000
}
