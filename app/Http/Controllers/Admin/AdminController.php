<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Apiservice;

class AdminController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $mipaquete =  Apiservice::request("mipaquete",[],0);
        return view('admin.home.home',compact('mipaquete'));
    }

    public function loginmipaquete(Request $request){
        $data = $request->all();
        $res = Apiservice::request("mipaquete/login",$data,1);
        echo "<pre>";
        print_r($res);
        //return redirect()->route('home-admin');
    }
}
