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
		$e_setting = Setting::getSetting('system');
		foreach ($e_setting as $k0 => $v0) {
			View::share('mete_'.$v0['key'], $v0['value']);
		}
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
