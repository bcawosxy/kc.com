<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function __construct()
	{
		$this->middleware('adminlogin', ['except' => ['logout']]);
	}

	public function about()
	{
		echo 123;
//		$data = [];
//		$about = About::where('category', 'about_c')
//			->select('about.*', 'admin.name as admin_name')
//			->leftJoin('admin', 'about.modify_id', '=', 'admin.id')
//			->first();
//
//		if($about) {
//			$data = [
//				'value' => ($about->value) ? $about->value : null,
//				'updated_at' => ($about->updated_at) ? $about->updated_at : null,
//				'modify_name' => ($about->admin_name) ? $about->admin_name : null,
//			];
//		}
//
//		return view('admin.about', ['data' => $data]);
	}

	public function aboutEdit(Request $request) {
		$user = Auth::user();

		if(About::where('category', 'about_c')->update(['value'=>$request->value, 'modify_id'=>$user->id])) {
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
}
