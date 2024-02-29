<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $filtro = [];
        if(isset($data['busqueda'])){
            $filtro['search'] = $data['busqueda'];
        }
        if(isset($data['category'])){
            $filtro['category'] = $data['category'];
        }
        $contents =  Apiservice::request("product",$filtro,0);
        $categories = $this->getCategories();
        $status = $this->getStatus();
        $campus = $this->getCampus();
        return view('admin.product.index', compact('contents','categories','status','campus'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        $status = $this->getStatus();
        $campus = $this->getCampus();
        return view('admin.product.create',compact('categories','status','campus'));
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

        for ($i=1; $i < 10; $i++) { 
           $nameimage = "image_".$i;
            if ($request->file($nameimage)) {
                $post[$nameimage] = curl_file_create($_FILES[$nameimage]['tmp_name'], $_FILES[$nameimage]['type'], $_FILES[$nameimage]['name']);
            }
        }

        

        $res = Apiservice::request("product/create",$post,1);
        return redirect()->route('product.index')->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit($id)
    {
        $categories = $this->getCategories();
        $status = $this->getStatus();
        $campus = $this->getCampus();
        $content =  Apiservice::request("product/detail/".$id,[],0);
        return view('admin.product.edit', compact('content','categories','status','campus'));
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
        for ($i=1; $i < 10; $i++) { 
            $nameimage = "image_".$i;
             if ($request->file($nameimage)) {
                 $post[$nameimage] = curl_file_create($_FILES[$nameimage]['tmp_name'], $_FILES[$nameimage]['type'], $_FILES[$nameimage]['name']);
             }
         }
        //var_dump($post);
        $res = Apiservice::request("product/update/".$id,$post,3);
        //var_dump($res);
         return redirect()->route('product.index')->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Apiservice::request("product/delete/".$id,[],2);
        return redirect()->route('product.index')->with('success', 'Contenido eliminado exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $data = $request->all(); 
        $res = Apiservice::request("product/updateorder",$data,1);
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

    public function getCategories(){
        $array = [];
        $array[''] = "Seleccione...";
        $contents = Apiservice::request("categories",[],0);
        foreach ($contents as $key => $content) {
            $array[$content->id] = $content->name;
        }
        return $array;
    }

    public function getStatus(){
        $array = [];
        $array[''] = "Seleccione...";
        $array['1'] = "Nuevo con empaque";
        $array['2'] = "Nuevo sin empaque";
        $array['3'] = "Nuevo con etiqueta";
        $array['4'] = "Nuevo sin etiqueta";
        $array['5'] = "Nuevo con defectos";
        $array['6'] = "Usado";
        $array['7'] = "Usado con etiqueta";
        $array['8'] = "Usado una postura";
        $array['9'] = "Usado con defectos";
        return $array;
    }

    public function getCampus(){
        $array = [];
        $array[''] = "Seleccione...";
        $contents = Apiservice::request("campus",["dispatch"=>'1'],0);
        foreach ($contents as $key => $content) {
            $array[$content->id] = $content->name;
        }
        return $array;
    }
}
