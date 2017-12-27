<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Admin;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Service;
use App\Model\Showcase;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KcController extends Controller
{
    public function about() {
        $data = [];
        $about = Setting::getSetting('about', 'content');

        if($about) {
            $data = [
                'value' => ($about['value']) ? $about['value'] : null,
                'updated_at' => ($about['updated_at']) ? $about['updated_at'] : null,
            ];
        }

        return view('kc-metalwork.about', ['data' => $data]);
    }

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

	public function product($page = 1)
	{
	    $take = 12;
        $skip = ($page-1)*$take;

        $total = Product::where('status', 'open')->count();
        $allPages = (($total%$take) !== 0) ? floor($total/$take)+1 : ($total/$take) ;

		$products = Product::where('status', 'open')->orderBy('updated_at' ,'desc')->skip($skip)->take($take)->get();
		$data = [
		    'currentPage' => $page,
		    'allPages' => $allPages,
            'products' => array(),
        ];

		foreach ($products as $k0 => $v0) {
			$data['products'][] = [
				'id' => $v0['id'],
				'name' => $v0['name'],
				'cover' =>  asset("storage/images/product/").DIRECTORY_SEPARATOR.$v0['cover'],
				'status' => get_label($v0['status']),
				'showcase' => get_label($v0['showcase']),
				'admin' => Admin::getAdmin($v0['admin_id'])['name'],
				'updated_at' => $v0['updated_at'],
				'url' => url()->route('KC::content', ['id' => $v0['id']]),
			];
		}

		return view('kc-metalwork.product', ['data' => $data]);
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
