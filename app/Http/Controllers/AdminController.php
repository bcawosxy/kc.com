<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Admin;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Service;
use App\Model\Showcase;
use App\Library\UploadHandler;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminlogin', ['except' => ['logout']]);
	}

	public function about()
	{
		$about = Setting::getSetting('about', 'content');

		$data = [];

		if($about) {
			$data = [
				'value' => ($about['value']) ? $about['value'] : null,
				'updated_at' => ($about['updated_at']) ? $about['updated_at'] : null,
				'admin' => ($about['admin_id']) ? Admin::getAdmin($about['admin_id']) : null,
			];
		}

		return view('admin.about', ['data' => $data]);
	}

	public function aboutEdit(Request $request) {
		$user = Auth::user();

		if(Setting::where(['code' => 'about', 'key' => 'content'])->update(['value'=>$request->value, 'admin_id' => $user->id])) {
			$result = 1;
			$message = '修改完成';
		} else {
			$result = 0;
			$message = '修改失敗, 請重新操作';
		}
		$redirect =  url()->route('admin::about');

		return json_encode_return($result, $message, $redirect );
	}

	public function banner() {

	    $banner = Setting::getSetting('system', 'banner');
        $banners =[];
	    foreach (json_decode($banner['value'], true) as $k0 => $v0) {
			if(file_exists(public_path("storage/images/banner/").'/'.$v0)) {
				$imagesize = getimagesize(public_path("storage/images/banner/") . '/' . $v0);
				$banners[] = [
					'name' => $v0,
					'url' => url()->asset("storage/images/banner/") . '/' . $v0,
					'size' => $imagesize[0] . ' x ' . $imagesize[1],
				];
			}
        }

	    $data = [
	        'banners' => $banners,
        ];

	    return view('admin.banner', ['data' => $data]);
    }

	public function bannerEdit(Request $request)
	{
        $user = Auth::user();
        $oldImages = []; $newImages = [];
		$images = $request->images;
		$uploadPath = public_path("upload/files/").DIRECTORY_SEPARATOR;
		$storagePath  = public_path("storage/images/banner/").DIRECTORY_SEPARATOR;

		foreach ($images as $k0 => $v0) {
			if($v0['set'] == 'old') $oldImages[] = $v0['filename'];
			if($v0['set'] == 'new') $newImages[] = $v0['filename'];
			$allImages[] = $v0['filename'];
		}

		//先將banner目錄中不在本次使用的舊圖片移除, 保留重複使用的圖片
		foreach (glob($storagePath."*.jpg") as $filename) {
            $fileinfo = pathinfo($filename);
            $_file = $fileinfo['filename'].'.'.$fileinfo['extension'];
			if(!in_array( $_file , $oldImages)) unlink($filename);
		}

		//搬新圖片到目錄內
		foreach ($newImages as $k0 => $v0) {
			rename( $uploadPath.$v0 , $storagePath.$v0);
		}

		$result = Setting::updateSetting('system', 'banner', json_encode($allImages), $user->id);
        $redirect = url()->route('admin::banner');
        $message = ($result) ? '修改完成' :  '修改失敗, 請重新操作' ;

        return json_encode_return($result, $message, $redirect );
    }

	public function fileUpload()
	{
		$options = array(
			'image_versions' => [],
		);
		$upload = new UploadHandler($options);
	}

    public function getService()
    {
        $services = Service::orderBy('sort', 'asc')->get();

        foreach ($services as $k0 => $v0) {
            $service['data'][] = [
                'sort' => $v0['sort'],
                'name' => $v0['name'],
                'title' =>$v0['title'],
                'id' => $v0['id'],
            ];
        }

        return json_encode($service);
	}

    public function index()
    {

        $data = [];

        return view('admin.index', ['data' => $data]);
    }

    public function info()
    {
        $data = [];
        $sysyem = Setting::getSetting('system');
        if($sysyem) {
            foreach ($sysyem as $k0 => $v0) {
                $data[$v0['key']] = $sysyem[$k0];
            }
        }

        $info = Setting::getSetting('info');
        if($info) {
            foreach ($info as $k0 => $v0) {
                $data[$v0['key']] = $info[$k0];
            }
        }
        return view('admin.info', ['data' => $data ]);
    }

	public function infoEdit(Request $request)
	{
		$user = Auth::user();
		$data = $request->data;
		$images = $request->images;

		$result = 1;
		$message = '修改完成';
		$redirect = url()->route('admin::info');

		/**
		 *  網頁描述及聯絡資訊欄位
		 */
		foreach (json_decode($data , true) as $k0 => $v0) {
			if(!Setting::where(['code' => $v0['code'], 'key' => $v0['key']])->update(['value'=> $v0['value'], 'admin_id' => $user->id])){
				$result = 0;
				$message = '修改失敗, 請重新操作';
				goto _return;
			}
		}

		/**
		 *  Logo & Icon 欄位
		 */
		foreach (json_decode($images , true) as $k0 => $v0) {
			$UploadPath = public_path("upload/files/").DIRECTORY_SEPARATOR.$v0['value'];
			$StoragePath  = public_path("images/").DIRECTORY_SEPARATOR.$v0['key'].'.png';

			if(!rename($UploadPath, $StoragePath)){
				$result = 0;
				$message = '['.$v0['key'].']圖片移動失敗, 請重新操作';
				goto _return;
			} else {
				$message = '修改完成, 請按下 Ctrl + F5 更新圖片。';
			}
		}

		_return :
		return json_encode_return($result, $message, $redirect);
    }

	public function logout()
	{
		Auth::logout();
		return redirect()->route('KC::login');
	}

	public function product()
	{
		$products = Product::getProducts();
        $data = [];
		foreach (json_decode($products, true) as $k0 => $v0) {
			$data[] = [
				'id' => $v0['id'],
				'name' => $v0['name'],
				'status' => get_label($v0['status']),
				'showcase' => get_label($v0['showcase']),
				'admin' => Admin::getAdmin($v0['admin_id'])['name'],
				'updated_at' => $v0['updated_at'],
				'url' => url()->route('admin::productContent', ['id' => $v0['id']]),
			];
		}

		return view('admin.product', ['data' => $data]);
	}

	public function productContent($id = null)
	{
		$act = (is_null($id)) ? 'add' : 'edit';
		switch ($act) {
			case 'add' :
				$product = [
					'status' => 'open',
					'showcase' => 1,
				];
				break;

			case 'edit' :
				$product = json_decode(Product::getProduct($id), true);
				$product['coverUrl'] = asset("storage/images/product/").DIRECTORY_SEPARATOR.$product['cover'];
				$product['admin'] = Admin::getAdmin($product['admin_id'])['name'];

				break;

			default :
				// handle some error here...
				break;
		}

		$data = [
			'act' => $act,
			'product' => $product,
		];


		return view('admin.product_content', ['data' => $data]);
	}

	public function productDelete(Request $request)
	{
		$id = $request->id;

		$result = 0;
		$message = '刪除失敗, 請重新操作。';
		$redirect = url()->route('admin::productContent', ['id' => $id]);

        if(!Showcase::where('product_id', $id)->delete() ) {
            goto _return;
        }

		if( Product::where('id', $id)->update(['status' => 'delete']) ) {
			$result = 1;
			$message = '成功刪除。';
			$redirect = url()->route('admin::product');
		}

        _return :
		return json_encode_return($result, $message, $redirect );
	}

	public function productEdit(Request $request)
	{
		$user = Auth::user();
		//要取得的 POST Key
		$postParams = ['id', 'act', 'name', 'content', 'status', 'showcase', 'cover', 'cover_state'];
		foreach ($postParams as $v0) { $$v0 = $request->$v0; }
		if($name == '' || $status == '' || $showcase == '' ||  $cover == '' ) return json_encode_return(0, '資料未填寫完成, 請重新操作');

		//若是新上傳的圖要進行處裡
		if($cover_state == 'new') {
            $coverName = uniqid().'.png';
            base64toImage($cover, storage_path("app/public/images/product/$coverName"));
		} else {
		    $coverName = $cover;
        }

		$params = [
			'name'      => $name,
			'content'   => $content,
			'status'    => $status,
			'showcase'  => $showcase,
			'cover'     => $coverName,
			'admin_id'  => $user->id,
		];

		$result = 0;
		$message = '錯誤, 請重新操作';
		$redirect = null;

		if($act == 'add') {
			$params['created_at'] = $params['updated_at'] = inserttime();
			if(Product::insert($params)) {
				$result = 1;
				$message = '新增資料完成';
				$redirect = url()->route('admin::product');
			}
		} else {
            if( $showcase == 0 || $status == 'close') {
               Showcase::where('product_id', $id)->delete();
            }

			if (Product::where('id', $id)->update($params)) {
                $result = 1;
                $message = '修改資料完成';
                $redirect = url()->route('admin::productContent', ['id' => $id]);
			}
		}

		_return :
		return json_encode_return($result, $message, $redirect );
	}

	public function refreshService(Request $request)
	{
		$act = $request->act;
		$data = $request->data;

		switch ($act) {

			case 'add' :
				$max = Service::max('sort');
				$insert = [
					'name' => $data[0]['name'],
					'title' => $data[0]['title'],
					'sort' => ($max+1),
				];

				Service::insert($insert);
				break;

			case 'delete' :
				//還在table上的id
				foreach($data as $k0 => $v0) {
					$availableID[] = $v0['id'];
				}

				//資料庫內全部的id
				$service = Service::select(['id'])->get();
				foreach(json_decode($service, true) as $k0 => $v0) {
					$id[] = $v0['id'];
				}

				//被刪除的id資料排序
				$deleteServiceSort = Service::select(['sort'])->where('id', array_values(array_diff($id, $availableID))[0])->first();

				//取得原本排序大於被移除項目的清單
				$reSort = Service::where('sort', '>', json_decode( $deleteServiceSort, true )['sort'])->get();

				foreach ( json_decode($reSort, true) as $k0 => $v0 ) {
					Service::where('id', $v0['id'])->update(['sort'=>($v0['sort']-1)]);
				}

				Service::whereNotIn('id', $availableID)->delete();

				break;

			case 'update' :
				foreach($data as $k0 => $v0) {
					$edit = [
						'sort' => $v0['sort'],
						'name' => $v0['name'],
						'title' => $v0['title'],
					];
					Service::where('id', $v0['id'])->update($edit);
				}
				break;
		}

		return json_encode_return(1);
	}

	public function service()
	{
		$services = Service::getServices();

		$data = [
			'services' => $services,
		];

		return view('admin.service', ['data' => $data]);
	}

    public function showcase()
    {
        $e_showcase = Showcase::getShowcases();
        $showcase = [];
        $onCase = [];
        foreach (json_decode($e_showcase, true) as $k0 => $v0) {
            $showcase[] = [
                'id' => $v0['id'],
                'name' => $v0['name'],
                'cover' => url()->asset('storage/images/product').DIRECTORY_SEPARATOR.$v0['cover'],
            ];

            $onCase[] = $v0['id'];
        }

        $e_product2showcase = Product::getProducts2Showcase();
        $product = [];
        foreach (json_decode($e_product2showcase, true) as $k0 => $v0) {
            if(!in_array($v0['id'], $onCase)) {
                $product[] = [
                    'id' => $v0['id'],
                    'name' => $v0['name'],
                    'cover' => url()->asset('storage/images/product') . DIRECTORY_SEPARATOR . $v0['cover'],
                ];
            }
        }

        $data = [
            'product' => $product,
            'showcase' => $showcase,
        ];

        return view('admin.showcase', ['data' => $data]);
    }

    public function showcaseUpdate(Request $request)
    {
        $id = ($request->id) ? $request->id : [];

        Showcase::truncate();

        foreach ($id as $k0 => $v0) {
            Showcase::insert(['product_id' => $v0, 'sort' => ($k0+1)]);
        }

        return json_encode_return(1);
    }
}
