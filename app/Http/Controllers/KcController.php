<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KcController extends Controller
{
	public function index($page = 1)
	{

		return view('welcome');
	}
}
