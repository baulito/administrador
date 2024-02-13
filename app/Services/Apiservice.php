<?php
namespace App\Services;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\RequestOptions;

class Apiservice
{

    public static function request($metodo,$data = [],$tipo = null,$multipart=null){

        $url = env("API_URL").$metodo;
        //echo $url;
        /*echo "<pre>";
        print_r($archivos);
        echo "</pre>";*/
        //$data = json_encode($data);
        $client = new Client();
        $header = [];
        $header['Accept'] = 'application/json';
        $header['Content-Type'] = 'application/x-www-form-urlencoded';
        if(Session::get('access_token')){
            $header['Authorization'] = "Bearer ".Session::get('access_token')."";
        }
        if(isset($tipo) && $tipo == 1){
            $metodo = "POST";
        } else if(isset($tipo) && $tipo == 3){
            $metodo = "PUT";
        } else if(isset($tipo) && $tipo == 2){
            $metodo = "DELETE";
        } else{
            $metodo = "GET";
        }
        try {
            if($metodo == "GET"){
                $response = $client->request($metodo,$url."?".http_build_query($data),["headers" =>$header]);
            } else{
                if($multipart != null){
                    $header['Content-Type'] = 'multipart/form-data';
                    foreach ($data as $name => $param) {
                       $df = [];
                       $df['name'] = $name;
                       $df['contents'] = $param; 
                        array_push($multipart,$df);
                    }
                    $option = [
                        "headers" =>$header,
                        RequestOptions::MULTIPART => $multipart,
                    ];
                    echo "<pre>";
                    print_r($option);
                    $response = $client->request($metodo,$url,$option);
                } else {
                    $response = $client->request($metodo,$url,["headers" =>$header,'form_params' => $data]);
                }
                
            }  
            if ($response->getBody()) {
                $res =  $response->getBody();
                $array = json_decode($res);
            }
            return $array; 
        } catch (\Exception $e) { 
           
            if(method_exists($e, 'getResponse')){
                $response = $e->getResponse();
                $responseBodyAsString = $response->getBody()->getContents();
                return json_decode($responseBodyAsString,true);  
            }  else {
                echo "Error: " . $e->getMessage(); 
            } 
           
        }
       
    }

    public static function formatFile($file,$name){
        $imagenBase64 = base64_encode(file_get_contents($file->getRealPath()));
        return [
            'name'     => $name, // Nombre del campo de la imagen en el formulario
            'contents' => base64_decode($imagenBase64), // Contenido de la imagen
            'filename' => $file->getClientOriginalName() // Nombre del archivo
        ];
    }
    

}

