<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table = 'service';
	
	static function getService($id)
	{
		$return = Service::where('id', $id)->first();

		return json_decode($return, true);
	}
	
	static function getServices()
	{
		$return = Service::orderBy('sort', 'asc')->get();

		return json_decode($return, true);
	}
}
