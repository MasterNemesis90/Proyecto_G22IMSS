<?php

namespace App\Http\Controllers;

use App\Mail\DatosFinales;
use App\Mail\RecuperarContraseña;
use App\Models\Tenats;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;

class ControllerRegistro extends Controller
{
    
    public function vista($precio){

        $data = file_get_contents("paises.json");
        $pises = json_decode($data, true);

        return view('LandingPage.partes.registrar',compact('precio','pises'));
    }

    public function login(){
        return view('auth.login');
    }

    public function enlace(){
        return view('LandingPage.enlace');
    }

    public function inicio(){
        return view('index');
    }

    public function autentificar(){
        return view('LandingPage.partes.autentificar');
    }

    public function pruebaIncio(){

        if (Tenats::where('correo', '=', 'g22@gmail.com')->exists()) {

            $auth = User::where('correo', "g22@gmail.com")->where('contraseña', 'hola')->first();

            Auth::login($auth);
            $nombre = session(['nombre' => $auth->nombre_completo]);
            return redirect()->route('inicioG22');
         
            // return view('Dashboard.inicio_dashboard');

        }else{

        $Tenats = new Tenats();

        $Tenats->nombre_medico = "Prueba G22";
        $Tenats->correo = "g22@gmail.com";
        $Tenats->cedula = 1;
        $Tenats->fecha_nacimiento = "2001-01-01";
        $Tenats->nacionalidad = "cr";
        $Tenats->telefono = 777777;
        $Tenats->pais_estadia = "cr";
        $Tenats->genero = "1";
       
        $Tenats->fecha_pago_efectuado = date('Y-m-d');
        $Tenats->proximo_pago = "2023-01-01";
        $Tenats->nombre_clinica =  "ACM";
        $Tenats->telefono_cliinica = 00;
        $Tenats->ubicacion_clinica =  "azul";
        $Tenats->logo_clinica =  "logo.png";
        $Tenats->tipo_plan = "Empresarial";
        $Tenats->codigo_paypal = "aprovado";
        $Tenats->estado = 1;
        $Tenats->cuenta_validad = 1;
        $Tenats->contraseña = "hola";

        $Tenats->save();

        $usuarios = new User();
        $usuarios->id_tenant =  $Tenats->id_tenant ;
        $usuarios->correo =  $Tenats->correo ;
        $usuarios->tipo_usuario =  "Administrador" ;
        $usuarios->contraseña =    $Tenats->contraseña;
        $usuarios->nombre_completo = $Tenats->nombre_medico ;
        $usuarios->fecha_ingreso = date("Y-m-d"); 
        $usuarios->id_estado = $Tenats->estado;
        $usuarios->save();
        // Guardar el tenant en la tabla de usuarios
        
        $auth = User::where('correo', $usuarios->correo)->where('contraseña', $usuarios->contrasena)->first();

        $nombre = session(['nombre' => "Prueba22"]);

        Auth::login($usuarios);
       
        return redirect()->route('inicioG22');
        }

    }



    public function inicioG22(){

       
        return view('Dashboard.inicio_dashboard');

        
        
        
    }
    // Metodo de muestra prueba para mostrar ejemplo
    // public function inicioG22P(){

    //     // echo [$_COOKIE['correo']];

    //     return view('Dashboard.paginas.contenido_ejemplo');
    // }



    public function registrarse(Request $request){

        if ($this->mayorEdad($request->fecha)<=18) {
    
            return back()->with('error', 'Usted debe ser mayor de edad para obtener este servicio');

        }else{

        if (Tenats::where('correo', '=', $request->email)->exists()) {

            return back()->with('error', 'El correo ya se encuentra registrado');
            
         }else{

        $Tenats = new Tenats();

        $Tenats->nombre_medico = $request->nombre;

      
        $Tenats->correo = $request->email;
        $Tenats->cedula = 1;
        $Tenats->fecha_nacimiento = $request->fecha;
        $Tenats->nacionalidad = $request->nacionalidad;
        $Tenats->telefono = $request->telefono;
        $Tenats->pais_estadia = $request->pais;
        $Tenats->genero = "1";
       
        
        $Tenats->fecha_pago_efectuado = "2001-01-01";
        $Tenats->proximo_pago = "2001-01-01";
        $Tenats->nombre_clinica =  $request->clinica;
        $Tenats->telefono_cliinica = 00;
        $Tenats->ubicacion_clinica =  "azul";
        $Tenats->logo_clinica =  "logo.png";

        if($request->precio == 320){
            $Tenats->tipo_plan = "Empresarial";
        }else{
            $Tenats->tipo_plan = "Estandar";
        }
       
        $Tenats->codigo_paypal = "No aprovado";
        $Tenats->estado = 2;
        $Tenats->cuenta_validad = 2;
        $Tenats->contraseña = $this->contraseñaAletoria(3);

        $Tenats->save();

        $id_tenant = $Tenats->id_tenant;
        $precio = $request->precio;


        return view('LandingPage.partes.paypal',compact('id_tenant','precio'));

         }

        }

        


        // return redirect()->route('pagar')->with( ['id_tenant' => $id_tenant] );

        // return view('LandingPage.partes.paypal');
     
    }

    function mayorEdad($fecha){
        $nacimiento = new DateTime($fecha);
        $ahora = new DateTime(date("Y-m-d"));
        $diferencia = $ahora->diff($nacimiento);
        return $diferencia->format("%y");
    }

    function contraseñaAletoria($length){
        $bytes = openssl_random_pseudo_bytes($length);
        $pass = bin2hex($bytes);
         return $pass;
           
    }





    public function autentificarDatos(Request $request,$id){
      $correo= $request->email;
      $contraseña=  $request->contraseña;

        $tenant = Tenats::where('id_tenant',session('id_tenant'))->first();

        if($correo == $tenant->correo){
            if ($contraseña == $tenant->contraseña) {

                $this->update($id);

                return redirect()->route("loginPrincipal")->with('exito',"Ya eres parte de la familia G22IMSS");
              
            }else{
                return back()->with('error', "Datos incorrectos");
            }

        }else{
            return back()->with('error', "Datos incorrectos");
        }



      
    }


    public function update($id){

        $Tenats = Tenats::findOrFail($id);

        $Tenats->nombre_medico = $Tenats->nombre_medico;
        $Tenats->correo =  $Tenats->correo ;
        $Tenats->cedula =  $Tenats->cedula ;
        $Tenats->fecha_nacimiento =    $Tenats->fecha_nacimiento;
        $Tenats->nacionalidad = $Tenats->nacionalidad ;
        $Tenats->telefono = $Tenats->telefono ;
        $Tenats->pais_estadia = $Tenats->pais_estadia;
        $Tenats->genero = $Tenats->genero;
       
        
        $Tenats->fecha_pago_efectuado =   $Tenats->fecha_pago_efectuado;    ;
        $Tenats->proximo_pago =    $Tenats->proximo_pago ;
        $Tenats->nombre_clinica =  $Tenats->nombre_clinica;
        $Tenats->telefono_cliinica =  $Tenats->telefono_cliinica;
        $Tenats->ubicacion_clinica =  $Tenats->ubicacion_clinica;
        $Tenats->logo_clinica =   $Tenats->logo_clinica ;

        $Tenats->tipo_plan =  $Tenats->tipo_plan ;
        $Tenats->codigo_paypal = $Tenats->codigo_paypal;
        $Tenats->estado =  3;
        $Tenats->cuenta_validad = 1;
        $Tenats->contraseña =  $Tenats->contraseña ;

        $Tenats->save();

        $usuarios = new User();
        $usuarios->id_tenant =  $Tenats->id_tenant ;
        $usuarios->correo =  $Tenats->correo ;
        $usuarios->tipo_usuario =  "Administrador" ;
        $usuarios->contraseña =    $Tenats->contraseña;
        $usuarios->nombre_completo = $Tenats->nombre_medico ;
        $usuarios->fecha_ingreso = date("Y-m-d"); 
        // $usuarios->especialidad = "";
        $usuarios->id_estado = $Tenats->estado;
        $usuarios->save();
        // Guardar el tenant en la tabla de usuarios
     
    }


    public function recuperarContraseña(Request $request){
        $user = User::where("correo",$request->correo)->first();
        $aletoria = $this->contraseñaAletoria(3);
        if($user != ""){

            if($user->id_estado == 1){

                if ($user->tipo_usuario == "Administrador") {
                    Tenats::where('id_tenant', $user->id_tenant)
                    ->update(['contraseña' =>  $aletoria]);            
                }
    
                User::where('correo', $request->correo)
                ->update(['contraseña' =>  $aletoria]);
    
    
             $userFinal = User::where("correo",$request->correo)->first();


             $this->correo($user->correo,'Recuperar contraseña',$userFinal);
    
                // $correoNuevo = new RecuperarContraseña($userFinal);
                // Mail::to($user->correo)->send($correoNuevo);
    
    
    
                return back()->with('exitoContra', 'Revisar buzón de correo')->with('usuario', $user->id_usuario);
    
            }else{
                return back()->with('mensajeRecu', 'El usuario se encuentra desactivado');
            }
    
            }else{
                return back()->with('mensajeRecu', 'El correo no pertence a ningun usuario');
            }

}


    public function recuperarContraseñaFinal(Request $request,$id){

        $user = User::where("id_usuario",$id)->first();

        if($user->contraseña == $request->temporal){

        if($user->tipo_usuario == "Administrador"){

            $this->updateContra($id,$request->contraseñaNueva,1,$user->id_tenant);

            return back()->with('exitoContraNueva', 'La contraseña ha sido actualizada');

        }else{

            $this->updateContra($id,$request->contraseñaNueva,2,$user->id_tenant);

            return back()->with('exitoContraNueva', 'La contraseña ha sido actualizada');

        }

        }else{
            return back()->with('mensajeRecuFinal', 'Datos incorrectos');
        }

    }


    public function updateContra($id,$contraseña,$valor,$tenant){

        if ($valor == 1) {
            User::where('id_usuario', $id)
            ->update(['contraseña' =>  $contraseña]);

            Tenats::where('id_tenant', $tenant)
            ->update(['contraseña' =>  $contraseña]);

        } else {
            User::where('id_usuario', $id)
            ->update(['contraseña' =>  $contraseña]);
        }
        
  

     
    }

    public function actualizarContraseñaSegura(Request $request,$id,$id_tenant){

            User::where('id_usuario', $id)
            ->update(['contraseña' =>  $request->contraseña]);

            User::where('id_usuario', $id)
            ->update(['id_estado' =>  1]);

            Tenats::where('id_tenant', $id_tenant)
            ->update(['contraseña' =>  $request->contraseña]);

            Tenats::where('id_tenant', $id_tenant)
            ->update(['estado' =>  1]);

            $userFinal = User::where("id_usuario",auth()->user()->id_usuario)->first();

            $this->correo($userFinal->correo,'Datos finales de inicio de sesión',$userFinal);

            // $correoNuevo = new DatosFinales($userFinal);
            // Mail::to($userFinal->correo)->send($correoNuevo);


            return back()->with('exito', 'La contraseña ha sido actualizad con exito');

    }


    public function correo($to,$sujeto,$tenant){

        $to = $tenant->correo;
        $subject = $sujeto;

        $message  = "Su correo es :".$tenant->correo."\r\n";
        $message  .= "Su contraseña temporal es :".$tenant->contraseña;

        $cabeceras = 'From: G22IMSS@gmail.com' . "\r\n" .
        'Reply-To: G22IMSS@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
   
    
         
        mail($to, $subject, $message,$cabeceras);

        return back();

    }


}



