<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'service';
	
	static public function getServices()
	{
		$return = Service::orderBy('sort', 'asc')->get();

		return json_decode($return, true);
	}
}
