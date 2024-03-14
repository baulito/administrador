<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;
use App\Helpers\Pagination;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $filtro = [];
        if(isset($data['page'])){
            $filtro['page'] = $data['page'];
        }
        if(isset($data['busqueda'])){
            $filtro['search'] = $data['busqueda'];
        }
        if(isset($data['level'])){
            $filtro['level'] = $data['level'];
        }
        $users =  Apiservice::request("user",$filtro,0);
        if (isset($users->data)) {
            $contents = $users->data; 
        } else {
            $contents = [];
        }

        if (isset($data['page'])) {
            unset($data['page']);
        }
        $filters = $data;
        $documentType = $this->getTipoDocumentos();
        $pagination = Pagination::getPages($users,$data);
        $Levels = $this->getLevels();
        return view('admin.users.index', compact('contents','filters','pagination','Levels'));
    }

    public function create()
    {
        $documentType = $this->getTipoDocumentos();
        $Levels = $this->getLevels();
        return view('admin.users.create',compact('documentType','Levels'));
    }

    public function store(Request $request)
    {
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        Apiservice::request("user/create",$post,1);
        return redirect()->route('users.index')->with('success', 'Contenido creado exitosamente.');
    }

    public function show(Contents $content)
    {
        return view('admin.users.show', compact('content'));
    }

    public function edit($id)
    {
        $content =  Apiservice::request("user/detail/".$id,[],0);
        $documentType = $this->getTipoDocumentos();
        $Levels = $this->getLevels();
        return view('admin.users.edit', compact('content','documentType','Levels'));
    }

    public function update(Request $request,$id)
    {
        $post = $request->all();
        if ($request->file("image")) {
            $post['image'] = curl_file_create($_FILES['image']['tmp_name'], $_FILES['image']['type'], $_FILES['image']['name']);
        }
        $res = Apiservice::request("user/update/".$id,$post,3);
        //var_dump($res);
        return redirect()->route('users.index')->with('success', 'Contenido actualizado exitosamente.');
    }

    public function destroy($id)
    {
        Apiservice::request("user/delete/".$id,[],2);
        return redirect()->route('contents.index')->with('success', 'Contenido eliminado exitosamente.');
    }


    public function getSections(){
        $array = [];
        $array[''] = "Seleccione...";
        $array[1] = "Por qúe";
        $array[2] = "Seguro";
        $array[3] = "Preguntas";
        return $array;
    }

    
    public function getTipoDocumentos(){
        $array = [];
        $array[''] = "Seleccione...";
        $array['CC'] = "Cedula de Ciudadania";
        $array['CE'] = "Cedula de Extranjeria";
        $array['PA'] = "Pasaporte";
        return $array;
    }
    public function getLevels(){
        $array = [];
        $array[''] = "Seleccione...";
        $array['1'] = "Administrador";
        $array['2'] = "Comprador";
        return $array;
    }
}
