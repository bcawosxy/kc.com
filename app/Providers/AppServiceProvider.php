<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Model\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
	public function boot()
	{
	    //取得meta資料
		$e_setting = Setting::getSetting('system');
		foreach ($e_setting as $k0 => $v0) {
			View::share('mete_'.$v0['key'], $v0['value']);
		}

        //取得底部info資訊
        //info
        $e_info = Setting::getSetting('info');
        $info = [];
        foreach ($e_info as $k0 => $v0) {
            $info[$v0['key']] = $v0['value'];
        }
        View::share('info', $info);

        //取得底部icon
        View::share('icon', url()->asset("/images") . DIRECTORY_SEPARATOR . 'icon.png');

        //navbar 用的menu active class
        $routeName = url()->full();
        if(strpos($routeName, 'about')) {
        	$action = 'about';
		} else if(strpos($routeName, 'product')|| strpos($routeName, 'content')) {
        	$action = 'product';
		} else if(strpos($routeName, 'contact')) {
        	$action = 'contact';
        } else {
        	$action = 'index';
		}

		View::share('action', $action);
	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
