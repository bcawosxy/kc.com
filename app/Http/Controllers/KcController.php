<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Service;
use App\Model\Showcase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KcController extends Controller
{
	public function index($page = 1)
	{
		$data = [];

		//Banner
		$e_banner = Setting::getSetting('system', 'banner');
		$banners =[];
		foreach (json_decode($e_banner['value'], true) as $k0 => $v0) {
			if(file_exists(public_path("storage/images/banner/").DIRECTORY_SEPARATOR.$v0)) {
				$imagesize = getimagesize(public_path("storage/images/banner/") . DIRECTORY_SEPARATOR . $v0);
				$banners[] = [
					'name' => $v0,
					'url' => url()->asset("storage/images/banner/") . DIRECTORY_SEPARATOR . $v0,
					'size' => $imagesize[0] . ' x ' . $imagesize[1],
				];
			}
		}
		$data['banner'] = $banners;

		//Services
		$e_services = Service::getServices();
		$services =[];
		foreach ($e_services as $k0 => $v0) {
			$services[] = [
				'id' => $v0['id'],
				'name' => $v0['name'],
				'title' => $v0['title'],
			];
		}
		$data['service'] = $services;

		//showcase
		$e_showcase = Showcase::getShowcases();
		$showcase = [];
		foreach ($e_showcase as $k0 => $v0) {
			$showcase[] = [
				'id' => $v0['id'],
				'name' => $v0['name'],
				'url' => url()->route('KC::index'),
				'cover' => url()->asset('storage/images/product').DIRECTORY_SEPARATOR.$v0['cover'],
			];
		}
		$data['showcase'] = $showcase;

		//info
		$e_info = Setting::getSetting('info');
		$info = [];
		foreach ($e_info as $k0 => $v0) {
			$info[$v0['key']] = $v0['value'];
		}
		$data['info'] = $info;

		$data['icon'] = url()->asset("/images") . DIRECTORY_SEPARATOR . 'icon.png';

		return view('kc-metalwork.index', ['data' => $data]);
	}

    public function login(Request $request)
    {

        if (Auth::attempt(['account' => $request->account, 'password' => $request->password])) {
            //登入完成 進入後台
//
//            $user = Auth::user();
//            $param = [
//                'ip' => $request->ip(),
//            ];
//
//            Admin::where('id', $user->id)->update($param);

            return redirect()->route('admin::index');
        } else {
            //登入失敗 回到登入頁
            return redirect()->route('KC::login')->withErrors(['msg' => '帳號或密碼錯誤, 請重新登入。']);
        }
    }

    public function ShowLoginPage()
    {
        if (!Auth::check()) {
            return view('kc-metalwork.login');
        } else {
            return redirect()->route('admin::index');
        }
    }
}
