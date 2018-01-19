<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Access;
use App\Model\Admin;
use App\Model\Contact;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Service;
use App\Model\Showcase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Routing\Controller;

class KcController extends Controller
{
	public function __construct()
	{
		include_once (app_path('Library/Functions.php'));
	}

    public function about() {
        $data = [];
        $about = Setting::getSetting('about', 'content');

        if($about) {
            $data = [
                'value' => ($about['value']) ? $about['value'] : null,
                'updated_at' => ($about['updated_at']) ? $about['updated_at'] : null,
            ];
        }

        return view('kc-metalwork.about', ['data' => $data, 'meta_title' => '關於我們']);
    }

	public function contact()
	{

		$services = Service::getServices();

		$data = [
			'services' => $services,
		];

		return view('kc-metalwork.contact', ['data' => $data, 'meta_title' => '聯絡我們']);
    }

    public function contactAdd(Request $request)
    {

        $data = $request->value;

        if($data['service'] && $data['service'] != 'other') {
            $service = Service::getService($data['service'])['name'];
        } else {
            $service = $data['service'];
        }

		if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
			return json_encode_return(0, 'Email格式錯誤, 請重新輸入。');
		}

        $params = [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'content' => $data['content'],
            'service' => $service,
            'email' => $data['email'],
            'created_at' => inserttime(),
            'ip' => $request->ip(),
        ];

        if(Contact::insert($params)) {
            return json_encode_return(1, '您的訊息已成功提交, 我們將盡速與您聯繫, 謝謝。', url()->route('KC::contact'));
        } else {
            return json_encode_return(0, '錯誤, 請重新操作, 謝謝。', url()->route('KC::contact'));
        }
    }
    
	public function content(Request $request,  $id = null)
	{
		$product = Product::getProduct($id);

		if(!$product) return redirect()->route('KC::product');

		$data = [
			'product' => $product,
		];

		if(!$request->hasCookie('access_'.$id)) {
			//離半夜12點剩下幾分鐘
			$leftMinutes = floor((strtotime(date('Y-m-d 23:59:59')) - time())/60).'<br>';
			Access::RefreshAccess($id);
			Cookie::queue('access_'.$id, $id, $leftMinutes);
		}

		return view('kc-metalwork.content', ['data' => $data, 'meta_title' => $product['name'].' - 實績案例']);
    }
    
	public function index()
	{
		$data = [];

		//Banner
		$e_banner = Setting::getSetting('system', 'banner');
		$banners =[];
		foreach (json_decode($e_banner['value'], true) as $k0 => $v0) {
			if(file_exists(public_path("images/banner/").DIRECTORY_SEPARATOR.$v0)) {
				$imagesize = getimagesize(public_path("images/banner/") . DIRECTORY_SEPARATOR . $v0);
				$banners[] = [
					'name' => $v0,
					'url' => asset("images/banner/") . DIRECTORY_SEPARATOR . $v0,
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
				'url' =>  url()->route('KC::content', ['id' => $v0['id']]),
				'cover' => asset('images/product').DIRECTORY_SEPARATOR.$v0['cover'],
			];
		}
		$data['showcase'] = $showcase;

		return view('kc-metalwork.index', ['data' => $data]);
	}

    public function login(Request $request)
    {
        if (Auth::attempt(['account' => $request->account, 'password' => $request->password])) {
            return redirect()->route('admin::index');
        } else {
            //登入失敗 回到登入頁
            return redirect()->route('KC::login')->withErrors(['msg' => '帳號或密碼錯誤, 請重新登入。'])->withInput();
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
				'cover' =>  asset("images/product/").DIRECTORY_SEPARATOR.$v0['cover'],
				'status' => get_label($v0['status']),
				'showcase' => get_label($v0['showcase']),
				'admin' => Admin::getAdmin($v0['admin_id'])['name'],
				'updated_at' => $v0['updated_at'],
				'url' => url()->route('KC::content', ['id' => $v0['id']]),
			];
		}

		return view('kc-metalwork.product', ['data' => $data, 'meta_title' => '實績案例']);
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
