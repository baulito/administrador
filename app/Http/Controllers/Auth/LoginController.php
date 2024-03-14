<?php
 
namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Services\Apiservice;

class LoginController extends Controller
{


    /**
     * Funcion para hacer Login
     * envia al servicio el usuario y la contraseña para su validacion y hace el respectivo login en caso de ser correcto
     *
     * @param Request $request
     * @bodyParam email
     * @bodyParam password
     * @return void
     */
    public function login(Request $request)
    {
        $usuario = Session::get('usuario');
        if(!isset($usuario)){
            $post = $request->all();
            $datos = [];
            if(isset($post['email'])){
                $datos['email'] = $post['email'];
            } else if(isset($post['username'])){
                $datos['user'] = $post['username'];
            }
        

            $datos['password'] = $post['password'];
            //print_r($datos);
            $data = Apiservice::request("usuarios/login",$datos,1);
            /*echo "<pre>";
            print_r($data);*/
            if(isset($data->access_token)){
                Session::put('usuario',$data->usuario);
                Session::put('access_token',$data->access_token);
                return redirect()->intended(Session::get('previous_url', '/'));
            } else {
                $error ="ha ocurrido un error intente mas tarde";
                if(isset($data['error'])){
                    $error = $data['error'];
                } else if(isset($data['message'])){
                    $error = $data['message'];
                }
            //return redirect('/login')->with("mensaje",$error);
            }
        } else {
            return redirect('/');
        }
        
    }

    /**
     * Funcion pra cerrar la sesion en el sistema
     *
     * @return void
     */
    public function logout(){
        Session::forget('usuario');
        Session::forget('access_token');
        return  redirect('/administrador/login');
    }
}
