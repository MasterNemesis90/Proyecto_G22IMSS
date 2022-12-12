<?php

namespace App\Http\Controllers;

use App\Mail\Activacion;
use App\Models\Tenats;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payee;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use URL;
use Session;

class ControllerPayment extends Controller
{
    
    private $apiContext;

    public function __construct()
    {

        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);


    }


    public function payWithPayPal(Request $request) {

        // return $request;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();

        // Aqui se puede obtener rel precio del producto que se va a pagar
        $amount->setTotal($request->precio);
        $amount->setCurrency('USD');


        // Aqui se crea una transaccion
        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $transaction->setDescription('Plan estandar');

        // Se le puede agregar una descripcion a la trasaccion
        $transaction->setDescription('Ya hicistes el pago correctamente');

        $callbackUrl = url('/paypal/status/');

        session(['id_tenant' => $request->id_tenant]);

        $redirectUrls = new RedirectUrls();
        // Cuando el usuario no tiene dinero en su cuenta entra aquí
        $redirectUrls->setReturnUrl($callbackUrl)
        // Aqui es si el usuario cancela la transacción
            ->setCancelUrl($callbackUrl);


           
        $payment = new Payment();
         // Lo que estamos haciendo,una venta como tal, por eso sale, esta palabra no se cambia
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);


            // Ya aqui es para que el pago se pueda hacer
        try {
            // crea un pago
            $payment->create($this->apiContext);

            return redirect()->away($payment->getApprovalLink());
       
            // Exepcion si ocurre un error en el pago, o credenciales
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {

        // return $request;

        // Este metodo como tal es cuando ya le sale el recibo al usuario y este le da continuar
        // dd($request->all());
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

      

        /** Execute the payment **/
         $result = $payment->execute($execution, $this->apiContext);
         

        //  Aprovado
        if ($result->getState() === 'approved') {
            $status1 = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';

            $this->update(session('id_tenant'));

            return redirect('autentificar');

            return view('LandingPage.partes.autentificar');

            // en este redirecc se pone una vista como tal
          
        }

        // No aprovado
        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
         // en este redirecc se pone una vista como tal
        return redirect('/')->with(compact('status'));
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
       
        
        $Tenats->fecha_pago_efectuado = date("Y-m-d"); 
        $Tenats->proximo_pago =  date("Y-m-d", strtotime ("1years"));
        $Tenats->nombre_clinica =  $Tenats->nombre_clinica;
        $Tenats->telefono_cliinica =  $Tenats->telefono_cliinica;
        $Tenats->ubicacion_clinica =  $Tenats->ubicacion_clinica;
        $Tenats->logo_clinica =   $Tenats->logo_clinica ;

        $Tenats->tipo_plan =  $Tenats->tipo_plan ;
        $Tenats->codigo_paypal = "aprovado";
        $Tenats->estado =  $Tenats->estado;
        $Tenats->cuenta_validad = $Tenats->cuenta_validad ;
        $Tenats->contraseña =  $Tenats->contraseña ;

        $Tenats->save();


       


        $tenant = Tenats::where('id_tenant',session('id_tenant'))->first();
        $this->correo($tenant->correo,'Datos de activación',$tenant);

        // $correo = new Activacion($tenant);
        // Mail::to($tenant->correo)->send($correo);

        
        $id_tenant = session('id_tenant');

        return view('LandingPage.partes.autentificar',compact('id_tenant'));
     
    }


    
    public function correo($to,$sujeto,$tenant){

        $to = $tenant->correo;
        $subject = "Activacion";

        $message  = "Su correo es :".$tenant->correo."\r\n";
        $message  .= "Su contraseña temporal es :".$tenant->contraseña;

        $cabeceras = 'From: G22IMSS@gmail.com' . "\r\n" .
        'Reply-To: G22IMSS@gmail.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
   
    
         
        mail($to, $subject, $message,$cabeceras);

        return back();

    }

}
