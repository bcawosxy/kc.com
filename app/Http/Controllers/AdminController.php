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

	public function serviceEdit(Request $request)
	{

	}
}
