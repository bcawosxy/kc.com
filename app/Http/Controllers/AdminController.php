<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {


        $data = [];

        return view('admin.index', ['data' => $data]);
    }
}
