<?php

namespace App\Http\Controllers;

use App\Models\Tenats;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesionController extends Controller
{
  public function iniciarsesion(Request $request){


    $auth = User::where('correo', $request->correo)->where('contraseña', $request->contrasena)->first();

    if($auth){

      if ($auth->tipo_usuario == "SuperAdmin") {

         Auth::login($auth);
         $sesion = session(['tenant' => $auth->id_tenant]);
         $correo = session(['correo' => $auth->correo]);
         $nombre = session(['nombre' => $auth->nombre_completo]);
         return redirect()->route('administrador');

     
      }else{

      if($auth->tipo_usuario == "Administrador"){

          $tenant = Tenats::where('id_tenant', $auth->id_tenant)->first();

           if($tenant->cuenta_validad == 1 ){
  
               if($tenant->estado == 1 || $tenant->estado == 3 && $tenant->proximo_pago > date("Y-m-d")){

                  Auth::login($auth);
                  $sesion = session(['tenant' => $auth->id_tenant]);
                  $correo = session(['correo' => $auth->correo]);
                  $nombre = session(['nombre' => $auth->nombre_completo]);
                  return redirect()->route('inicioG22');

              }else{
  
                return back()->with('mensaje1','Este usuario esta desactivado, o no ha efectuado el pago del plan');
        
              }
  
          }else{
            return back()->with('mensaje2','No ha verificado la cuenta');
              // return "No ha verificado la cuenta";
          }
  
        }else{

        if ($auth->tipo_usuario == "Usuario") {

            $tenant = Tenats::where('id_tenant', $auth->id_tenant)->first();
  
              if($auth->id_estado == 1 && $tenant->estado == 1 && $tenant->proximo_pago > date("Y-m-d")){
 
                
                 Auth::login($auth);
                 $sesion = session(['tenant' => $auth->id_tenant]);
                 $correo = session(['correo' => $auth->correo]);
                 $nombre = session(['nombre' => $auth->nombre_completo]);
                 return redirect()->route('inicioG22');

             }else{
              return back()->with('mensaje3','Este usuario esta desactivado, o su usuario principal esta desactivado');
             }
          

          }

        }

      }

  
    }else{
        return back()->with('mensaje','Datos no encontrados')->with('nombre', $request->correo)->with('contra',$request->contrasena);
      }



  }


  public function cerrar(Request $request) {
   Auth::logout();
   return redirect()->route('loginPrincipal');
  }
}
