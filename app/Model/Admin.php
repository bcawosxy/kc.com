<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admin';

    static function getAdmin($admin_id) {

    	$return = Admin::where('id', $admin_id)->first();

    	return json_decode($return, true);
	}
}
