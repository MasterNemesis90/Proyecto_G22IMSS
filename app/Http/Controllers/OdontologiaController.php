<?php

namespace App\Http\Controllers;

use App\Models\historiaRadiografica;
use Illuminate\Http\Request;
use App\Models\Odontologia;
use App\Models\Paciente;
use App\Models\Radiografia;
use App\Models\Odontograma;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class OdontologiaController extends Controller
{
    
    public function verOdontologia(){
        return view('Dashboard/paginas/Odontologia');
    }
 

    ///////////////////////////////CONFIGURACIONES DE ODONTOGRAMA///////////////////////////////////////////////////

    public function odontograma(){
        $pacientes = DB::table('pacientes')->get();
        return view('Dashboard/paginas/ModuloOdontologia/Odontograma',compact('pacientes'));
    }

    public function enviarOdontograma(Request $request){

        $request->file('imagen')->store('public');
        $imagen = $request->file("imagen");
    //    dd($imagen);

    srand (time());
     //generamos un número aleatorio
     $numero_aleatorio = rand(1,10000);

    if($request->hasFile("imagen")){
     $imagen = $request->file("imagen");
     $nombreimagen = Str::slug('odontograma'.$numero_aleatorio).".png";
     $ruta = public_path("/public/odontograma");

     $imagen->move($ruta,$nombreimagen);
      }

 
         Odontograma::create([
                     'ruta_odontograma'=>$nombreimagen,
                     'descripcion' => $request->diagnostico,
                     'id_paciente' => $request->id_paciente,
                     'diente' => $request->diente,
                     'diagnostico' => $request->diagnostico,
                 ]);
                 return back()->with('succes', 'Exito');


    }


    

    public function eliminarOdontrograma(Request $request){
    

        $data = Odontograma::find($request->id);
        $data->delete();

        
      // $id->delete();
       return back()->with('succes', 'Eliminado exitosamente');

    }

   








///////////////////////////////CONFIGURACIONES DE RADIOGRAFIA///////////////////////////////////////////////////
    public function radiografia(){
      //  $pacientes = DB::table('pacientes');

        $pacientes = DB::table('pacientes')->get();



        return view('Dashboard/paginas/ModuloOdontologia/FichaRadiografica', compact('pacientes'));
    }


    public function subir(Request $request)
    {
      //  print_r($request->paciente);
      //  exit;
           //Recibimos el archivo y lo guardamos en la carpeta storage/app/public
           $request->file('archivo')->store('public');
           $imagen = $request->file("archivo");
       //    dd($imagen);

       srand (time());
        //generamos un número aleatorio
        $numero_aleatorio = rand(1,10000);

       if($request->hasFile("archivo")){
        $imagen = $request->file("archivo");
        $nombreimagen = Str::slug('radiografia'.$numero_aleatorio).".png";
        $ruta = public_path("/public/odontologia");

        $imagen->move($ruta,$nombreimagen);
         }

        
   $data = Radiografia::create([
                'descripcion'=>$request->descripcion,
                'ruta_radiografia' => $nombreimagen,
                'id_paciente'=>$request->paciente,
                
            ]);


           return redirect()->route('radiografia');


           

         // redirect('radiografia');
    }


 
///////////////////////////////CONFIGURACIONES DE HISTORIAL///////////////////////////////////////////////////
    public function historial(){
        return view('Dashboard.paginas.ModuloOdontologia.Historial');
    }

   //////////////////////////HISTORIA R///////////////////////////////////////

   public function historiaR(){

    $datos = DB::table('radiografias')
             ->join('pacientes', 'radiografias.id_paciente', '=', 'pacientes.id_paciente')
      
             ->get();

        
   // $datos['historiasR']=Radiografia::paginate(10);
    return view('Dashboard.paginas.ModuloOdontologia.HistoriaRadiografica', compact('datos'));
   }


   

    public function create()
    {
        //
    }

    /**
     
     */
    public function store(Request $request)
    {
        //
    }

    /**
     
     */
    public function show($id)
    {
        //
    }

    /**
     
     */
    public function edit($id){

        $historiaR=Radiografia::findOrFail($id);
       //return view('Dashboard/paginas/ModuloOdontologia/FichaRadiografica', compact('historiaR'));

    }

    public function editarRadiografia(Request $request){
        
   
                      //Recibimos el archivo y lo guardamos en la carpeta storage/app/public
                      $request->file('imagen')->store('public');
                      $imagen = $request->file("imagen");
                      //print_r($imagen);
                    //  exit;
                  //    dd($imagen);
           
                  srand (time());
                   //generamos un número aleatorio
                   $numero_aleatorio = rand(1,10000);
           
                  if($request->hasFile("imagen")){
                   $imagen = $request->file("imagen");
                   $nombreimagen = Str::slug('radiografia'.$numero_aleatorio).".png";

                   $ruta = public_path("/public/odontologia");
                   $imagen->move($ruta,$nombreimagen);

                  }

        Radiografia::where('id', $request->id)
                ->update(['descripcion' => $request->descripcion,
                'ruta_radiografia' => $nombreimagen,
            
            ]);

       
        

            return back()->with('succes', 'Exito');
    
}

    /**
    
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
   
     */
    public function destroy($id)
    {
   

     Radiografia::destroy($id);
      // $id->delete();
       return back()->with('succes', 'Eliminado exitosamente');

    }


 //////////////////////////HISTORIA O///////////////////////////////////////

public function editarOdontograma(Request $request){


$request->file('imagen')->store('public');
        $imagen = $request->file("imagen");
    //    dd($imagen);

    srand (time());
     //generamos un número aleatorio
     $numero_aleatorio = rand(1,10000);

    if($request->hasFile("imagen")){
     $imagen = $request->file("imagen");
     $nombreimagen = Str::slug('odontograma'.$numero_aleatorio).".png";
     $ruta = public_path("/public/odontograma");

     $imagen->move($ruta,$nombreimagen);
      }



Odontograma::where('id', $request->id)
        ->update([
            'diagnostico' =>  $request->diagnostico,
            'ruta_odontograma' =>  $nombreimagen,
            'diente' =>  $request->diente,
    
    ]);

    return back()->with('succes', 'Exito');

}

 public function historiaO(){


    $datos = DB::table('pacientes')
             ->join('odontogramas', 'pacientes.id_paciente', '=', 'odontogramas.id_paciente')
             
             ->get();

           //  print_r($datos);
          //   exit;

    
    return view('Dashboard.paginas.ModuloOdontologia.HistorialOdontograma' , compact('datos'));
   }


}
    







 

