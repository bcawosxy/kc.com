<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Admin;
use App\Model\Product;
use App\Model\Setting;
use App\Model\Service;
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

	public function fileUpload()
	{
		$options = array(
			// This option will disable creating thumbnail images and will not create that extra folder.
			// However, due to this, the images preview will not be displayed after upload
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

	public function logout()
	{
		Auth::logout();
		return redirect()->route('KC::login');
	}

	public function product()
	{
		$products = Product::getProducts();

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

		if( Product::where('id', $id)->update(['status' => 'delete']) ) {
			$result = 1;
			$message = '成功刪除。';
			$redirect = url()->route('admin::product');
		}

		return json_encode_return($result, $message, $redirect );
	}

	public function productEdit(Request $request)
	{
		$user = Auth::user();
		//要取得的 POST Key
		$postParams = ['id', 'act', 'name', 'content', 'status', 'showcase', 'cover', 'cover_state'];
		foreach ($postParams as $v0) { $$v0 = $request->$v0; }
		if($name == '' || $status == '' || $showcase == '' ||  $cover == '' ) return json_encode_return(0, '資料未填寫完成, 請重新操作');

		//若是新上傳的圖要進行搬移
		if($cover_state == 'new') {
			$coverUploadPath = public_path("upload/files/$cover");
			$coverStoragePath  = storage_path("app/public/images/product/$cover");
			$r_renameCover = rename($coverUploadPath, $coverStoragePath);
			if(!$r_renameCover) return  json_encode_return(0, '圖片處理失敗, 請重新操作', url()->route('admin::productContent', ['id' => $id]));
		}

		$params = [
			'name'  => $name,
			'content' => $content,
			'status' => $status,
			'showcase' => $showcase,
			'cover' => $cover,
			'admin_id' => $user->id,
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
			if (Product::where('id', $id)->update($params)) {
				$result = 1;
				$message = '修改資料完成';
				$redirect = url()->route('admin::productContent', ['id' => $id]);
			}
		}

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
		$services = Service::orderBy('sort', 'asc')->get();

		$data = [
			'services' => json_decode($services, true),
		];

		return view('admin.service', ['data' => $data]);
	}
}
