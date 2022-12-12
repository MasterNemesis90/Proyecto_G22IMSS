<?php

use App\Http\Controllers\ControllerOrden_Compra;
use App\Http\Controllers\ControllerProveedor;
use App\Http\Controllers\ControllerInventario;
use App\Http\Controllers\ControllerCuentaPorPagar;
use App\Http\Controllers\ControllerReportesCXP;
use App\Http\Controllers\ControllerCitas;
use App\Http\Controllers\ControllerDermatologia;
// use App\Http\Controllers\ControllerEstado;
use App\Http\Controllers\ControllerFormas_de_Pago;
// use App\Http\Controllers\ControllerLicencia;
use App\Http\Controllers\ControllerPaciente;
use App\Http\Controllers\ControllerPaquetes;
use App\Http\Controllers\ControllerPayment;
use App\Http\Controllers\ControllerPediatria;
use App\Http\Controllers\ControllerPerfil;
use App\Http\Controllers\ControllerPsicologia;
use App\Http\Controllers\ControllerRegistro;
use App\Http\Controllers\ControllerReporte;
use App\Http\Controllers\ControllerServicios;
use App\Http\Controllers\ControllerSoporte;
use App\Http\Controllers\ControllerSugerencia;
use App\Http\Controllers\ControllerTenant;
use App\Http\Controllers\ControllerUsuarios;
use App\Http\Controllers\ControllerVersion;
use App\Http\Controllers\OdontologiaController;
use App\Http\Controllers\SesionController;
use App\Http\Controllers\ControllerCuentasCobrar;
use App\Mail\EmergencyCallReceived;
use App\Models\Tenats;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Router;

// Route::group(['middleware' => 'admin'], function () {

Route::get('/registro/{precio}', [ControllerRegistro::class, 'vista'])->name('vista');

Route::get('/loginPrincipal', [ControllerRegistro::class, 'login'])->name('loginPrincipal');

Route::post('/iniciarSesion', [SesionController::class, 'iniciarsesion'])->name('iniciarsesion');

Route::get('/inicioG22', [ControllerRegistro::class, 'inicioG22'])->name('inicioG22')->middleware('auth');

// });

// LandigPage
Route::get('/', [ControllerRegistro::class, 'inicio'])->name('inicio');

Route::get('/registrarse', [ControllerRegistro::class, 'registrarse'])->name('registrarse');

Route::get('/autentificar', [ControllerRegistro::class, 'autentificar'])->name('autentificar');

Route::get('/enlace', [ControllerRegistro::class, 'enlace'])->name('enlace');

Route::get('/autentificarEnlace', [ControllerRegistro::class, 'autentificar'])->name('autentificarEnlace');

Route::post('/autentificarDatos/{id}', [ControllerRegistro::class, 'autentificarDatos'])->name('autentificarDatos');

Route::post('/cerrar', [SesionController::class, 'cerrar'])->name('cerrar');

Route::post('/recuperarContraseña', [ControllerRegistro::class, 'recuperarContraseña'])->name('recuperarContraseña');

Route::post('/recuperarContraseñaFinal/{id}', [ControllerRegistro::class, 'recuperarContraseñaFinal'])->name('recuperarContraseñaFinal');

Route::post('/actualizarContraseñaSegura/{id_usuario}/{id_Tenant}', [ControllerRegistro::class, 'actualizarContraseñaSegura'])->name('actualizarContraseñaSegura');




// Esta es la ruta que me lleva a poder pagar con paypal
Route::get('/paypal/pay', [ControllerPayment::class, 'payWithPayPal'])->name('pago');


Route::get('/paypal/status/', [ControllerPayment::class, 'payPalStatus'])->name('status');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('contacto',function(){


//     $id_tenant=1;
//     $precio =200;
//     return view('LandingPage.partes.paypal',compact('id_tenant','precio'));
//     // date("Y-m-d", strtotime ("-1years"));
//     // $tenant = Tenats::find(1);



//     // return  date("Y-m-d", strtotime ("1years"));
// });



// Dasboard

// Usuarios
Route::get('/editarEstado/{id}', [ControllerUsuarios::class, 'editarEstado'])->name('editarEstado');

Route::get('/editarEstadoDesactivo/{id}', [ControllerUsuarios::class, 'editarEstadoDesactivo'])->name('editarEstadoDesactivo');

Route::resource('usuarios', ControllerUsuarios::class);


Route::resource('perfil', ControllerPerfil::class);

Route::get('/actualizarEmpresarial', [ControllerPerfil::class, 'storageEmpre'])->name('storageEmpre');


// Ruta para realizar pruebas y montar funcionalidades
Route::get('/inicioG22P', [ControllerRegistro::class, 'pruebaIncio'])->name('inicioG22P');

/** Separar rutas por nombre del modulo y su funcion por ejemplo **/

//Modulo dermatologia y sus funcionalidades
//...
//...
//...


//RUTAS DE LOS SERVICIOS

Route::resource('servicios',ControllerServicios::class);

Route::get('/editarS/{id}',[ControllerServicios::class,'edit'])->name('editar');

// FIN RUTAS SERVICIOS

//RUTA PACIENTES

Route::get('/crearPaciente', [ControllerPaciente::class, 'index'])->name('vistaCrear');

Route::get('/mostrarPacientes', [ControllerPaciente::class, 'mostrarP'])->name('mostrarP');

Route::get('creadoP/', [ControllerPaciente::class, 'create'])->name('crearP');

Route::put('/eliminado/{id_paciente}', [ControllerPaciente::class, 'destroy'])->name('eliminarP');

Route::get('/editar/{id}', [ControllerPaciente::class, 'buscar'])->name('actualizarP');

Route::put('/actualizado/{id}', [ControllerPaciente::class, 'update'])->name('listo');

Route::get('/pacientesDesactivados', [ControllerPaciente::class, 'mostrarPacientesD'])->name('pacientesD');

Route::put('/pacientesDesactivados/{id}', [ControllerPaciente::class, 'activarP'])->name('activarPaci');

// FIN RUTAS PACIENTES

//CITAS

Route::get('/lista_citas', [ControllerCitas::class,'ListaCitas'])->name('listaCitas');
 Route::get('/crear_cita', [ControllerCitas::class,'crearcita'])->name('crear_cita');
Route::post('/Generar_cita', [ControllerCitas::class,'Generarcita'])->name('generar_cita');

Route::get('/citas_pendientes', [ControllerCitas::class,'verCitasPendientes'])->name('citasPendintes');
Route::delete('/eliminarcita/{id}', [ControllerCitas::class,'eliminarcita'])->name('eliminarcita');

// FIN RUTAS CITAS

// RUTAS PEDIATRIA

Route::resource('/pediatria',ControllerPediatria::class);


Route::put('/atender/{id}',[ControllerPediatria::class,'atender'])->name('cambio');

Route::get('/consulta/{id}',[ControllerPediatria::class,'consulta'])->name('datos');

Route::post('/store/{id}',[ControllerPediatria::class,'crearDatos'])->name('crearDatos');

Route::get('/vacunas/{id}',[ControllerPediatria::class,'vacunas'])->name('vacuna');

Route::get('/verNV/{id}',[ControllerPediatria::class,'verNV'])->name('verNV');

Route::post('/crearV/{id}',[ControllerPediatria::class,'crearV'])->name('crearVacuna');

Route::get('/diagnosticos/{id}',[ControllerPediatria::class,'verDiagnostico'])->name('diagnostico');

Route::post('/crearD/{id}',[ControllerPediatria::class,'crearD'])->name('crearD');

Route::get('/medicamentos/{id}',[ControllerPediatria::class,'verMedi'])->name('medicinas');

Route::post('/crearM/{id}',[ControllerPediatria::class,'crearM'])->name('crearM');

// FIN RUTAS PEDIATRIA

// PARTE ADMINISTRATIVA
Route::get('/admin',[ControllerTenant::class,'admin'])->name('administrador')->middleware('auth');
//

Route::resource('tenants', ControllerTenant::class);
// Route::resource('estados', ControllerEstado::class);
Route::resource('formas_pagos', ControllerFormas_de_Pago::class);
Route::resource('soporte', ControllerSoporte::class);
Route::resource('sugerencias', ControllerSugerencia::class);
Route::resource('paquetes', ControllerPaquetes::class);
Route::resource('versiones', ControllerVersion::class);
// Route::resource('licencias', ControllerLicencia::class);
Route::resource('reportes', ControllerReporte::class);
Route::get('soporte/correo', [ControllerSoporte::class,"correo"])->name('soporte.correo');
Route::get('soporte/zoom', [ControllerSoporte::class,"zoom"])->name('soporte.zoom');
Route::get('sugerencias/responder', [ControllerSugerencia::class,"responder"])->name('sugerencias.responder');
Route::get('reportes/generar', [ControllerReporte::class,"generar"])->name('reportes.generar');
// Route::get('soporte', [ControllerSoporte::class,"index"])->name('soporte.index');


//Modulo odontologia y sus funcionalidades

Route::get('verOdontologia', [OdontologiaController::class, 'verOdontologia'])->name('verOdontologia');

Route::post('subir', [OdontologiaController::class, 'subir'])->name('subir');


//...Odontograma

 Route::get('odontograma', [OdontologiaController::class, 'odontograma'])->name('odontograma');
 Route::post('enviarOdontograma', [OdontologiaController::class, 'enviarOdontograma'])->name('enviarOdontograma');
 Route::post('editarOdontograma', [OdontologiaController::class, 'editarOdontograma'])->name('editarOdontograma');
 Route::post('eliminarOdontrograma', [OdontologiaController::class, 'eliminarOdontrograma'])->name('eliminarOdontrograma');

 //Route::get('odontograma', 'OdontologiaController@odontograma');

//...Radiografia

Route::get('radiografia', [OdontologiaController::class, 'radiografia'])->name('radiografia');


//...Historial//////////Radiografica

Route::get('historial', [OdontologiaController::class, 'historial'])->name('historial');

Route::post('editarRadiografia', [OdontologiaController::class, 'editarRadiografia'])->name('editarRadiografia');

Route::get('historiaR', [OdontologiaController::class, 'historiaR'])->name('historiaR');


//...Historial//////////Odontograma

Route::get('historiaO', [OdontologiaController::class, 'historiaO'])->name('historiaO');

Route::delete('historiaR/{id}', [OdontologiaController::class, 'destroy'])->name('destroy');

// Modulo de psicologia
Route::resource('psicologia', ControllerPsicologia::class);
Route::get('/paciente_psicologia', [ControllerPsicologia::class, 'paciente_psicologia'])->name('paciente_psicologia');
Route::get('/Inicio_paciente_psicologia', [ControllerPsicologia::class, 'Inicio_paciente_psicologia'])->name('Inicio_paciente_psicologia');
Route::get('/mostar_mensaje', [ControllerPsicologia::class, 'mostar_mensaje'])->name('mostar_mensaje');
Route::get('/crearSesion', [ControllerPsicologia::class, 'crearSesion'])->name('crearSesion');
Route::get('/guardarBitacora', [ControllerPsicologia::class, 'guardarBitacora'])->name('guardarBitacora');


//RUTAS DERMATOLOGIA

Route::resource('/dermatologia', ControllerDermatologia::class);
Route::get('/dermatologia/avance_paciente/exp/{id}', [ControllerDermatologia::class, 'controlar_avance'])->name('dermatologia.controlarAvance');
Route::put('/dermatologia/avance_paciente/exp/{id}', [ControllerDermatologia::class, 'actualizar_avance'])->name('dermatologia.actualizarAvance');

//FIN RUTAS DERMATOLOGIA

//RUTAS CXC

Route::resource('cxc', ControllerCuentasCobrar::class);
Route::get('/cxc.cobros',[ControllerCuentasCobrar::class,'cobros'])->name('cxc.cobros');
Route::put('/cxc.cancelar/{id_cobro}',[ControllerCuentasCobrar::class,'cancelar'])->name('cxc.cancelar');

//FIN RUTAS CXC


//RUTA Proveedores

Route::get('/VistacrearProveedor', [ControllerProveedor::class, 'index'])->name('vistaCrearProveedor');

Route::get('/mostrarProveedores', [ControllerProveedor::class, 'mostrarProveedores'])->name('mostrarProveedores');

Route::get('/crearProveedor', [ControllerProveedor::class, 'create'])->name('crearProveedor');

Route::delete('/eliminarProveedor/{id_proveedor}', [ControllerProveedor::class, 'eliminarProveedor'])->name('eliminarProveedor');

Route::get('/editarProveedor/{id_proveedor}', [ControllerProveedor::class, 'buscarProveedor'])->name('buscarProveedor');
Route::put('/actualizarProveedor/{id_proveedor}', [ControllerProveedor::class, 'updateProveedor'])->name('updateProveedor');

// INICIO RUTAS ORDENES DE COMPRA 

Route::get('/VistacrearOrden_Compra', [ControllerOrden_Compra::class, 'index'])->name('vistaCrearOrden_Compra');

Route::get('/mostrarOrdenes', [ControllerOrden_Compra::class, 'mostrarOrdenesCompra'])->name('mostrarOrdenes');

Route::get('/crearOrden_Compra', [ControllerOrden_Compra::class, 'create'])->name('crearOrden_Compra');

Route::delete('/eliminarOrdenCompra/{id_oden_compra}', [ControllerOrden_Compra::class, 'eliminarOrdenCompra'])->name('eliminarOrdenCompra');

Route::get('/editarOrdenCompra/{id_orden_compra}', [ControllerOrden_Compra::class, 'buscarOrdenCompra'])->name('buscarOrdenCompra');

Route::get('/editOrden/{id_orden_compra}', [ControllerOrden_Compra::class, 'editOrden'])->name('editOrden');

Route::put('/actualizarOrdenCompra/{id_orden_compra}', [ControllerOrden_Compra::class, 'updateOrdenCompra'])->name('updateOrdenCompra');

// Inicio rutas Inventario

Route::get('/vistacrearProducto', [ControllerInventario::class, 'index'])->name('vistaCrearProducto');

Route::get('/mostrarProductos', [ControllerInventario::class, 'mostrarInventario'])->name('mostrarInventario');

Route::get('/crearProducto', [ControllerInventario::class, 'crearNUevoProducto'])->name('crearProducto');

Route::get('/eliminarProducto/{id_producto}', [ControllerInventario::class, 'eliminarProducto'])->name('eliminarProducto');

Route::get('/editarProducto/{id_producto}', [ControllerInventario::class, 'buscarProducto'])->name('buscarProducto');
Route::put('/actualizarProducto/{id_producto}', [ControllerInventario::class, 'updateProducto'])->name('updateProducto');

//Inicio rutas CXP

Route::get('/vistacrearCuentaPorPagar', [ControllerCuentaPorPagar::class, 'index'])->name('vistaCrearCuentaPorPagar');
Route::get('/abonarCuentaPorPagar', [ControllerCuentaPorPagar::class, 'abonarCuentaPorPagar'])->name('abonarCuentaPorPagar');
Route::get('/cancelarCuentaPorPagar', [ControllerCuentaPorPagar::class, 'cancelarCuentaPorPagar'])->name('cancelarCuentaPorPagar');

Route::get('/mostrarCuentasPorPagar', [ControllerCuentaPorPagar::class, 'mostrarCuentasPorPagar'])->name('mostrarCuentasPorPagar');

Route::get('/crearCuentaPorPagar', [ControllerCuentaPorPagar::class, 'create'])->name('crearCuentaPorPagar');

Route::get('/eliminarCuentaPorPagar/{id_cuentasporpagar}', [ControllerCuentaPorPagar::class, 'eliminarCuentaPorPagar'])->name('eliminarCuentaPorPagar');

Route::get('/editarCuentaPorPagar/{id_cuentasporpagar}', [ControllerCuentaPorPagar::class, 'buscarCuentaPorPagar'])->name('buscarCuentaPorPagar');
Route::put('/actualizarCuentaPorPagar/{id_cuentasporpagar}', [ControllerCuentaPorPagar::class, 'updateCuentaPorPagar'])->name('updateCuentaPorPagar');

// Inicio Rutas del los Reportes 

Route::get('/reporteProveedores', [ControllerReportesCXP::class, 'reporteProveedores'])->name('reporteProveedores');
Route::get('/reporteOrdenesDeCompra', [ControllerReportesCXP::class, 'reporteOrdenesCompra'])->name('reporteOrdenesCompra');
Route::get('/reporteInventario', [ControllerReportesCXP::class, 'reporteInventario'])->name('reporteInventario');
Route::get('/reporteCuentaPorPagar', [ControllerReportesCXP::class, 'reporteCuentaPorPagar'])->name('reporteCuentaPorPagar');
Route::get('/reporteCuentaPorPagarPorFecha', [ControllerReportesCXP::class, 'reporteCuentaPorPagarPorFecha'])->name('reporteCuentaPorPagarPorFecha');
Route::get('/reporteCuentaPorFechaDeVencimiento', [ControllerReportesCXP::class, 'reporteCuentaPorFechaDeVencimiento'])->name('reporteCuentaPorFechaDeVencimiento');
Route::get('/reporteCuentaPorPagarVencidas', [ControllerReportesCXP::class, 'reporteCuentaPorPagarVencidas'])->name('reporteCuentaPorPagarVencidas');
Route::get('/reporteCuentaPorPagarPagadas', [ControllerReportesCXP::class, 'reporteCuentaPorPagarPagadas'])->name('reporteCuentaPorPagarPagadas');
Route::get('/reporteCuentaPorPagarProximasAVencer', [ControllerReportesCXP::class, 'reporteCuentaPorPagarProximasAVencer'])->name('reporteCuentaPorPagarProximasAVencer');