<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;

class CategoryController extends Controller
{
    public function index()
    {
        $contents =  Apiservice::request("categories",[],0);
        return view('admin.category.index', compact('contents'));
    }

    public function create()
    {
        return view('admin.category.create');
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
        Apiservice::request("categories/create",$post,1);
        return redirect()->route('category.index')->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        return view('admin.contents.show', compact('content'));
    }

    public function edit($id)
    {
        $content =  Apiservice::request("categories/detail/".$id,[],0);
        return view('admin.category.edit', compact('content'));
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
        $res = Apiservice::request("categories/update/".$id,$post,3);
        //var_dump($res);
        return redirect()->route('category.index')->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Apiservice::request("categories/delete/".$id,[],2);
        return redirect()->route('category.index')->with('success', 'Contenido eliminado exitosamente.');
    }

    public function updateOrder(Request $request)
    {
        $data = $request->all(); 
        $res = Apiservice::request("categories/updateorder",$data,1);
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
