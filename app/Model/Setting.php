<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    static function getSetting($code = null, $key = null) {
        $return = '';

        if( is_null($key)) {
            $return = Setting::where(['code' => $code])->get();
        } else if(!is_null($code)) {
            $return = Setting::where(['code' => $code, 'key' => $key])->first();
        }

        return json_decode($return, true);
    }
}
