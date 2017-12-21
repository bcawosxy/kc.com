<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Showcase extends Model
{
    protected $table = 'showcase';

    static function getShowcases() {
        $return = Showcase::where([['product.status', '=', 'open'], ['product.showcase', '=', '1']])
			->leftJoin('product', 'showcase.product_id', '=' , 'product.id')
			->orderBy('sort','asc')->get();

        return json_decode($return, true);
    }
}
