<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';

	static function getContacts()
	{
		$return = Contact::orderBy('created_at', 'asc')->get();

		return json_decode($return, true);
    }
}
