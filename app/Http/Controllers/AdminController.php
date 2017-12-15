<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Admin;
use App\Model\Setting;
use App\Model\Service;
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

	public function service()
	{
		$services = Service::orderBy('sort', 'asc')->get();

		$data = [
			'services' => json_decode($services, true),
		];

		return view('admin.service', ['data' => $data]);
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
}
