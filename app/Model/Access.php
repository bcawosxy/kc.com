<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $table = 'access';

    static function RefreshAccess($id) {
		$today = date('Y-m-d 00:00:00');

		$hasViewed = Access::where([['type', 'product'] ,['type_id', $id]  ,['created_at', $today]])->first();
		if ($hasViewed) {
			$viewed  = ($hasViewed->viewed)+1;
			$update = ['viewed'=>$viewed];
			Access::where([['type', 'product'] ,['type_id', $id] ,['created_at', $today]])->update($update);
		} else {
			$insert = [
				'type' => 'product',
				'type_id' => $id,
				'viewed' => 1,
				'created_at' => $today,
				'updated_at' => $today,
			];
			Access::insert($insert);
		}
	}
}
