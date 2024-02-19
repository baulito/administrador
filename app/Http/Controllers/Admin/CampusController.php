<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;

class CampusController extends Controller
{
    public function index()
    {
        $contents =  Apiservice::request("campus",[],0);
        $country = $this->getCountry();
        $city = $this->getCity();
        return view('admin.campus.index', compact('contents','country','city'));
    }

    public function create()
    {
        $country = $this->getCountry();
        $city = $this->getCity();
        return view('admin.campus.create',compact('country','city'));
    }

    public function store(Request $request)
    {
        $messages = [
            'title.required' => 'El título es obligatorio.',
            'url.required' => 'La url es obligatoria',
            'url.unique' => 'Ya hay un contenido usando esta url',
        ];
        $request->validate([
            'name' => 'required',
        ],$messages);
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        $res = Apiservice::request("campus/create",$post,1);
        return redirect()->route('campus.index')->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit($id)
    {
        $country = $this->getCountry();
        $city = $this->getCity();
        $content =  Apiservice::request("campus/detail/".$id,[],0);
        return view('admin.campus.edit', compact('content','country','city'));
    }

    public function update(Request $request,$id)
    {
        $messages = [
            'title.required' => 'El título es obligatorio.',
            'url.required' => 'La url es obligatoria',
            'url.unique' => 'Ya hay un contenido usando esta url',
        ];
        $request->validate([
            'name' => 'required',
        ],$messages);
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        //var_dump($post);
        $res = Apiservice::request("campus/update/".$id,$post,3);
        var_dump($res);
        //return redirect()->route('campus.index')->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Apiservice::request("campus/delete/".$id,[],2);
        return redirect()->route('contents.index')->with('success', 'Contenido eliminado exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $data = $request->all(); 
        $res = Apiservice::request("campus/updateorder",$data,1);
        return response()->json($res);
    }

    public function getCountry(){
        $array = [];
        $array[''] = "Seleccione...";
        $array['Colombia'] = "Colombia";
        return $array;
    }

    public function getCity(){
        $array = [];
        $array[''] = "Seleccione...";
        $ciudades = Apiservice::request("envio/ciudades",[],0);
        foreach ($ciudades as $key => $ciudad) {
            $array[$ciudad->locationCode] = $ciudad->locationName.", ".$ciudad->departmentOrStateName;
        }
        return $array;
    }
}
