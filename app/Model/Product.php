<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    static function getProduct($id) {
		$return = Product::where([['status', '!=', 'delete'], ['id', '=', $id]])->first();
		return $return;
	}

    static function getProducts() {
    	$return = Product::where('status', '!=', 'delete')->get();

		return json_decode($return, true);
	}

    static function getProducts2Showcase() {
        $return = Product::where([['status', '=', 'open'], ['showcase', '=', 1]])->get();

        return json_decode($return, true);
    }
}
