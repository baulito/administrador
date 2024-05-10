<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Contents;
use Illuminate\Support\Facades\Storage;
use App\Services\upload\ImageUpload;
use App\Services\Apiservice;

class SalesController extends Controller
{
    public function index()
    {
        $contents =  Apiservice::request("ventas",[],0);
        return view('admin.sales.index', compact('contents'));
    }

    public function show($id)
    {
        $content =  Apiservice::request("compra/detallecompra/".$id,[],0);
        if(((isset($content->informacionenvio) && !isset($content->informacionenvio[0])) ||(!isset($content->informacionenvio)) ) && $content->negocio_compra_tipoenvio != 1 ){
            $generacionGuia =  Apiservice::request("ventas/validargeneracionenvio/".$id,[],0);
        } else {
            $generacionGuia = false;
        }
        return view('admin.sales.detail', compact('content','generacionGuia'));
    }

    public function generarGuia($id)
    {
        //var_dump($id);
        Apiservice::request("ventas/generarenvio/".$id,[],0);
    }

    
}
