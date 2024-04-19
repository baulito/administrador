<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;

class BannerController extends Controller
{
    public function index()
    {
        $contents =  Apiservice::request("banner",[],0);
        return view('admin.banner.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        Apiservice::request("banner/create",$post,1);
        return redirect()->route('banner.index')->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        
    }

    public function edit($id)
    {
        $content =  Apiservice::request("banner/detail/".$id,[],0);
        return view('admin.banner.edit', compact('content'));
    }

    public function update(Request $request,$id)
    {
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        $res = Apiservice::request("banner/update/".$id,$post,3);
        //var_dump($res);
        return redirect()->route('banner.index')->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Apiservice::request("banner/delete/".$id,[],2);
        return redirect()->route('banner.index')->with('success', 'Contenido eliminado exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $data = $request->all(); 
        $res = Apiservice::request("banner/updateorder",$data,1);
        return response()->json($res);
    }

    public function getSections(){
        $array = [];
        $array[''] = "Seleccione...";
        $array[1] = "Por qúe";
        $array[2] = "Seguro";
        $array[3] = "Preguntas";
        return $array;
    }
}
