<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KcController extends Controller
{
	public function index($page = 1)
	{
		return view('kc-metalwork.index');
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
            return redirect()->route('pindelta::login')->withErrors(['msg' => '帳號或密碼錯誤, 請重新登入。']);
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
