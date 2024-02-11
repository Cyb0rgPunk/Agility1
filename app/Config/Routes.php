<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
//$routes->get('dashboard', 'Home::dashboard');
$routes->get('salir', 'CLogin::salir');
$routes->post('checkLog', 'CLogin::signin');


$routes->group('admin', function($routes){

    $routes->get('dashboard', 'Home::dashboard_administrador');
    
    //Usuarios
    $routes->get('AddUser','CUser::index');
    $routes->post('SaveUser','CUser::save');
    $routes->get('DeleteUser/(:num)', 'CUser::delete/$1');
    $routes->get('EditUser/(:num)', 'CUser::edit/$1');
    $routes->post('UpdateUser','CUser::update');

    //Pasajeros
    $routes->get('Pasajeros',"CPasajeros::index");
    $routes->post('SavePasajero','CPasajeros::save');
    $routes->get('EditPasajero/(:num)', 'CPasajeros::edit/$1');
    $routes->post('UpdatePasajero','CPasajeros::update');
    $routes->get('DeletePasajero/(:num)', 'CPasajeros::delete/$1');
    $routes->post('CargaPasajeros', 'CPasajeros::upload');
    

    //condcutores
    $routes->get('AddConductor','CConductores::index');
    $routes->post('SaveConductor','CConductores::save');
    $routes->get('DeleteConductor/(:num)', 'CConductores::delete/$1');
    $routes->get('EditConductor/(:num)', 'CConductores::edit/$1');
    $routes->post('UpdateConductor','CConductores::update');
    $routes->post('UploadConductores','CConductores::upload');

    //Centros de costos 
    $routes->get('CentroCostos',"CCentroCostos::index");
    $routes->post('SaveCentroCostos','CCentroCostos::save');

    //Tarifas
    $routes->get('Tarifas',"CTarifas::index");
    $routes->post('UploadTarifas','CTarifas::upload');
    $routes->get('TarifaAdicional/(:num)/(:alpha)', 'CTarifas::tarifa_adicional/$1/$2');
    $routes->post('SaveTarifaAdicional','CTarifas::save_tarifa_adicional');

    //Moviles
    $routes->get('Moviles',"CMovil::index");
    $routes->post('SaveMovil','CMovil::save');
    $routes->get('EditMovil/(:num)', 'CMovil::edit/$1');
    $routes->post('UpdateMovil','CMovil::update');
    $routes->get('DeleteMovil/(:num)', 'CMovil::delete/$1');
    $routes->post('UploadMoviles','CMovil::upload');

    //Cargar Solicitudes
    $routes->get('CargarRutas','CSubirRutas::index');

    //Sub zonas
    $routes->get('SubZonas',"CZonas::index");
    $routes->post('UploadSubZonas','CZonas::upload_sub_zonas');
    $routes->post('SaveSubZona','CZonas::save');
    $routes->get('EditSubZona/(:num)', 'CZonas::edit/$1');
    $routes->post('UpdateSubZona','CZonas::update');
    $routes->get('DeleteSubZona/(:num)', 'CZonas::delete/$1');


    
    
    //SolicitudesTripulacion
        $routes->post('UploadTripulacion/','CSolicitudesTripulacion::upload');
        $routes->get('SolicitudesTripulacion/(:num)','CSolicitudesTripulacion::index/$1');
        $routes->get('SolicitarTripulacion/','CSolicitudesTripulacion::solicitar');
        $routes->get('HistoricoTripulacion',"CSolicitudesTripulacion::historial");
        $routes->get('GetDetallesTripulacion/(:num)',"CSolicitudesTripulacion::detalles/$1");
        $routes->post('SaveSolicitudTripulacion','CSolicitudesTripulacion::save');
        $routes->get('EditSolicitudTripulacionv/(:num)', 'CSolicitudesTripulacion::edit/$1');
        $routes->post('UpdateSolicitudTripulacion','CSolicitudesTripulacion::update');
        $routes->get('DeleteSolicitudTripulacion/(:num)', 'CSolicitudesTripulacion::delete/$1');
        $routes->get('CancelarSolicitudTripulacion/(:num)','CSolicitudesTripulacion::cancelar/$1');
        $routes->get('AsignarMovilTripulacion/(:num)', 'CSolicitudesTripulacion::asignar/$1');
        $routes->post('ConfirmaAsignarMovilTripulacion','CSolicitudesTripulacion::asignar_confirmar');



    //SolicitudesVoucher
        $routes->post('UploadVoucher/','CSolicitudesVoucher::upload');
        $routes->get('SolicitudesVoucher/(:num)','CSolicitudesVoucher::index/$1');
        $routes->get('SolicitarVoucher/','CSolicitudesVoucher::solicitar');
        $routes->get('HistoricoVoucher',"CSolicitudesVoucher::historial");
        $routes->get('GetDetallesVoucher/(:num)',"CSolicitudesVoucher::detalles/$1");
        $routes->post('SaveSolicitudVoucher','CSolicitudesVoucher::save');
        $routes->get('EditSolicitudVoucher/(:num)', 'CSolicitudesVoucher::edit/$1');
        $routes->post('UpdateSolicitudVoucher','CSolicitudesVoucher::update');
        $routes->get('DeleteSolicitudVoucher/(:num)', 'CSolicitudesVoucher::delete/$1');
        $routes->get('CancelarSolicitudVoucher/(:num)','CSolicitudesVoucher::cancelar/$1');
        $routes->get('AsignarMovilVoucher/(:num)', 'CSolicitudesVoucher::asignar/$1');
        $routes->post('ConfirmaAsignarMovilVoucher','CSolicitudesVoucher::asignar_confirmar');

        //Rutas recogidas
        $routes->get('RutasRecogidas',"CRutasRecogidas::index");
        $routes->get('RutasRecogidas/(:num)',"CRutasRecogidas::index/$1");  
        $routes->post('FiltroFechas',"CRutasRecogidas::index_filtros");  
        


        $routes->post('SaveRuta','CPasajeros::save');
        $routes->get('EditRuta/(:num)', 'CPasajeros::edit/$1');
        $routes->post('UpdateRuta','CPasajeros::update');
        $routes->get('DeleteRuta/(:num)', 'CPasajeros::delete/$1');
        $routes->post('CargaRutas', 'CRutasRecogidas::upload');
        $routes->get('PasajerosRuta/(:num)/(:any)/(:any)', 'CRutasRecogidas::pasajeros_ruta/$1/$2/$3', ['as' => 'pasajeros_ruta']);
        $routes->post('AsignarMovilRuta', 'CRutasRecogidas::asignar_ruta');
        $routes->post('UpdateMovilRuta','CRutasRecogidas::asignar_movil_ruta');
        
        //Rutas reparto
        $routes->get('RutasReparto',"CRutasReparto::index");
        $routes->get('RutasReparto/(:num)',"CRutasReparto::index/$1");  
        $routes->post('FiltroFechasReparto',"CRutasReparto::index_filtros"); 
        $routes->post('CargaRutasReparto', 'CRutasReparto::upload');
        $routes->get('PasajerosRutaReparto/(:num)/(:any)/(:any)', 'CRutasReparto::pasajeros_ruta/$1/$2/$3', ['as' => 'pasajeros_ruta_reparto']); 
        $routes->post('UpdateMovilRutaReparto','CRutasReparto::asignar_movil_ruta');
        $routes->post('AsignarMovilRutaReparto', 'CRutasReparto::asignar_ruta');


});

$routes->group('coordinador', function($routes){

    $routes->get('dashboard', 'Home::dashboard_administrador');
    
    //Usuarios
    $routes->get('AddUser','CUser::index');
    $routes->post('SaveUser','CUser::save');
    $routes->get('DeleteUser/(:num)', 'CUser::delete/$1');
    $routes->get('EditUser/(:num)', 'CUser::edit/$1');
    $routes->post('UpdateUser','CUser::update');

    //Pasajeros
    $routes->get('Pasajeros',"CPasajeros::index");
    $routes->post('SavePasajero','CPasajeros::save');
    $routes->get('EditPasajero/(:num)', 'CPasajeros::edit/$1');
    $routes->post('UpdatePasajero','CPasajeros::update');
    $routes->get('DeletePasajero/(:num)', 'CPasajeros::delete/$1');
    $routes->post('CargaPasajeros', 'CPasajeros::upload');
    

    //condcutores
    $routes->get('AddConductor','CConductores::index');
    $routes->post('SaveConductor','CConductores::save');
    $routes->get('DeleteConductor/(:num)', 'CConductores::delete/$1');
    $routes->get('EditConductor/(:num)', 'CConductores::edit/$1');
    $routes->post('UpdateConductor','CConductores::update');
    $routes->post('UploadConductores','CConductores::upload');

    //Centros de costos 
    $routes->get('CentroCostos',"CCentroCostos::index");
    $routes->post('SaveCentroCostos','CCentroCostos::save');

    //Tarifas
    $routes->get('Tarifas',"CTarifas::index");
    $routes->post('UploadTarifas','CTarifas::upload');
    $routes->get('TarifaAdicional/(:num)/(:alpha)', 'CTarifas::tarifa_adicional/$1/$2');
    $routes->post('SaveTarifaAdicional','CTarifas::save_tarifa_adicional');

    //Moviles
    $routes->get('Moviles',"CMovil::index");
    $routes->post('SaveMovil','CMovil::save');
    $routes->get('EditMovil/(:num)', 'CMovil::edit/$1');
    $routes->post('UpdateMovil','CMovil::update');
    $routes->get('DeleteMovil/(:num)', 'CMovil::delete/$1');
    $routes->post('UploadMoviles','CMovil::upload');

    //Cargar Solicitudes
    $routes->get('CargarRutas','CSubirRutas::index');
    
    
    //SolicitudesTripulacion
        $routes->get('SolicitudesTripulacion/(:num)','CSolicitudesTripulacion::index/$1');
        $routes->get('SolicitarTripulacion/','CSolicitudesTripulacion::solicitar');
        $routes->get('HistoricoTripulacion',"CSolicitudesTripulacion::historial");
        //$routes->get('HistoricoAsignado',"CSolicitudesTripulacion::historial_asignado");
        $routes->get('GetDetallesTripulacion/(:num)',"CSolicitudesTripulacion::detalles/$1");
        //$routes->get('GetDetallesAsignado/(:num)',"CSolicitudesTripulacion::detalles_asignado/$1");
        $routes->post('SaveSolicitudTripulacion','CSolicitudesTripulacion::save');
        $routes->get('EditSolicitudTripulacionv/(:num)', 'CSolicitudesTripulacion::edit/$1');
        $routes->post('UpdateSolicitudTripulacion','CSolicitudesTripulacion::update');
        $routes->get('DeleteSolicitudTripulacion/(:num)', 'CSolicitudesTripulacion::delete/$1');
        $routes->get('CancelarSolicitudTripulacion/(:num)','CSolicitudesTripulacion::cancelar/$1');
        $routes->get('AsignarMovilTripulacion/(:num)', 'CSolicitudesTripulacion::asignar/$1');
        $routes->post('ConfirmaAsignarMovilTripulacion','CSolicitudesTripulacion::asignar_confirmar');

    //SolicitudesVoucher
        $routes->get('SolicitudesVoucher/(:num)','CSolicitudesVoucher::index/$1');
        $routes->get('SolicitarVoucher/','CSolicitudesVoucher::solicitar');
        $routes->get('HistoricoVoucher',"CSolicitudesVoucher::historial");
        //$routes->get('HistoricoAsignadoVoucher',"CSolicitudesVoucher::historial_asignado");
        $routes->get('GetDetallesVoucher/(:num)',"CSolicitudesVoucher::detalles/$1");
        //$routes->get('GetDetallesAsignadoVoucher/(:num)',"CSolicitudesVoucher::detalles_asignado/$1");
        $routes->post('SaveSolicitudVoucher','CSolicitudesVoucher::save');
        $routes->get('EditSolicitudVoucher/(:num)', 'CSolicitudesVoucher::edit/$1');
        $routes->post('UpdateSolicitudVoucher','CSolicitudesVoucher::update');
        $routes->get('DeleteSolicitudVoucher/(:num)', 'CSolicitudesVoucher::delete/$1');
        $routes->get('CancelarSolicitudVoucher/(:num)','CSolicitudesVoucher::cancelar/$1');
        $routes->get('AsignarMovilVoucher/(:num)', 'CSolicitudesVoucher::asignar/$1');
        $routes->post('ConfirmaAsignarMovilVoucher','CSolicitudesVoucher::asignar_confirmar');

    //Rutas recogidas
        $routes->get('RutasRecogidas',"CRutasRecogidas::index");
        $routes->get('RutasRecogidas/(:num)',"CRutasRecogidas::index/$1");
        $routes->post('FiltroFechas',"CRutasRecogidas::index_filtros");  

        $routes->post('SaveRuta','CPasajeros::save');
        $routes->get('EditRuta/(:num)', 'CPasajeros::edit/$1');
        $routes->post('UpdateRuta','CPasajeros::update');
        $routes->get('DeleteRuta/(:num)', 'CPasajeros::delete/$1');
        $routes->post('CargaRutas', 'CRutasRecogidas::upload');
        $routes->get('PasajerosRuta/(:num)/(:any)/(:any)', 'CRutasRecogidas::pasajeros_ruta/$1/$2/$3');
        $routes->post('AsignarMovilRuta', 'CRutasRecogidas::asignar_ruta');
        $routes->post('UpdateMovilRuta','CRutasRecogidas::asignar_movil_ruta'); 

    //Rutas reparto
        $routes->get('RutasReparto',"CRutasReparto::index");
        $routes->get('RutasReparto/(:num)',"CRutasReparto::index/$1");  
        $routes->post('FiltroFechasReparto',"CRutasReparto::index_filtros"); 
        $routes->post('CargaRutasReparto', 'CRutasReparto::upload');
        $routes->get('PasajerosRutaReparto/(:num)/(:any)/(:any)', 'CRutasReparto::pasajeros_ruta/$1/$2/$3', ['as' => 'pasajeros_ruta_reparto_c']); 
        $routes->post('UpdateMovilRutaReparto','CRutasReparto::asignar_movil_ruta');
        $routes->post('AsignarMovilRutaReparto', 'CRutasReparto::asignar_ruta');    

});

$routes->group('interventor', function($routes){
    
    $routes->get('dashboard', 'Home::dashboard_administrador');
    
    //Usuarios
    $routes->get('AddUser','CUser::index');
    $routes->post('SaveUser','CUser::save');
    $routes->get('DeleteUser/(:num)', 'CUser::delete/$1');
    $routes->get('EditUser/(:num)', 'CUser::edit/$1');
    $routes->post('UpdateUser','CUser::update');

    //Pasajeros
    $routes->get('Pasajeros',"CPasajeros::index");
    $routes->post('SavePasajero','CPasajeros::save');
    $routes->get('EditPasajero/(:num)', 'CPasajeros::edit/$1');
    $routes->post('UpdatePasajero','CPasajeros::update');
    $routes->get('DeletePasajero/(:num)', 'CPasajeros::delete/$1');
    $routes->post('CargaPasajeros', 'CPasajeros::upload');
    

    //condcutores
    $routes->get('AddConductor','CConductores::index');
    $routes->post('SaveConductor','CConductores::save');
    $routes->get('DeleteConductor/(:num)', 'CConductores::delete/$1');
    $routes->get('EditConductor/(:num)', 'CConductores::edit/$1');
    $routes->post('UpdateConductor','CConductores::update');
    $routes->post('UploadConductores','CConductores::upload');

    //Centros de costos 
    $routes->get('CentroCostos',"CCentroCostos::index");
    $routes->post('SaveCentroCostos','CCentroCostos::save');

    //Tarifas
    $routes->get('Tarifas',"CTarifas::index");
    $routes->post('UploadTarifas','CTarifas::upload');
    $routes->get('TarifaAdicional/(:num)/(:alpha)', 'CTarifas::tarifa_adicional/$1/$2');
    $routes->post('SaveTarifaAdicional','CTarifas::save_tarifa_adicional');

    //Moviles
    $routes->get('Moviles',"CMovil::index");
    $routes->post('SaveMovil','CMovil::save');
    $routes->get('EditMovil/(:num)', 'CMovil::edit/$1');
    $routes->post('UpdateMovil','CMovil::update');
    $routes->get('DeleteMovil/(:num)', 'CMovil::delete/$1');
    $routes->post('UploadMoviles','CMovil::upload');

    //Cargar Solicitudes
    $routes->get('CargarRutas','CSubirRutas::index');
    
    
    //SolicitudesTripulacion
        $routes->get('SolicitudesTripulacion/(:num)','CSolicitudesTripulacion::index/$1');
        $routes->get('SolicitarTripulacion/','CSolicitudesTripulacion::solicitar');
        $routes->get('HistoricoTripulacion',"CSolicitudesTripulacion::historial");
        //$routes->get('HistoricoAsignado',"CSolicitudesTripulacion::historial_asignado");
        $routes->get('GetDetallesTripulacion/(:num)',"CSolicitudesTripulacion::detalles/$1");
        //$routes->get('GetDetallesAsignado/(:num)',"CSolicitudesTripulacion::detalles_asignado/$1");
        $routes->post('SaveSolicitudTripulacion','CSolicitudesTripulacion::save');
        $routes->get('EditSolicitudTripulacionv/(:num)', 'CSolicitudesTripulacion::edit/$1');
        $routes->post('UpdateSolicitudTripulacion','CSolicitudesTripulacion::update');
        $routes->get('DeleteSolicitudTripulacion/(:num)', 'CSolicitudesTripulacion::delete/$1');
        $routes->get('CancelarSolicitudTripulacion/(:num)','CSolicitudesTripulacion::cancelar/$1');
        $routes->get('AsignarMovilTripulacion/(:num)', 'CSolicitudesTripulacion::asignar/$1');
        $routes->post('ConfirmaAsignarMovilTripulacion','CSolicitudesTripulacion::asignar_confirmar');

    //SolicitudesVoucher
        $routes->get('SolicitudesVoucher/(:num)','CSolicitudesVoucher::index/$1');
        $routes->get('SolicitarVoucher/','CSolicitudesVoucher::solicitar');
        $routes->get('HistoricoVoucher',"CSolicitudesVoucher::historial");
        //$routes->get('HistoricoAsignadoVoucher',"CSolicitudesVoucher::historial_asignado");
        $routes->get('GetDetallesVoucher/(:num)',"CSolicitudesVoucher::detalles/$1");
        //$routes->get('GetDetallesAsignadoVoucher/(:num)',"CSolicitudesVoucher::detalles_asignado/$1");
        $routes->post('SaveSolicitudVoucher','CSolicitudesVoucher::save');
        $routes->get('EditSolicitudVoucher/(:num)', 'CSolicitudesVoucher::edit/$1');
        $routes->post('UpdateSolicitudVoucher','CSolicitudesVoucher::update');
        $routes->get('DeleteSolicitudVoucher/(:num)', 'CSolicitudesVoucher::delete/$1');
        $routes->get('CancelarSolicitudVoucher/(:num)','CSolicitudesVoucher::cancelar/$1');
        $routes->get('AsignarMovilVoucher/(:num)', 'CSolicitudesVoucher::asignar/$1');
        $routes->post('ConfirmaAsignarMovilVoucher','CSolicitudesVoucher::asignar_confirmar');


});

$routes->group('pasajero', function($routes){

    $routes->get('dashboard', 'Home::dashboard_pasajero');
    
    $routes->get('/', 'CPasajeros::dashboard');
    
    $routes->get('Solicitudes/(:num)','CSolicitudes::index/$1');
    $routes->get('Solicitar/','CSolicitudes::solicitar');
    $routes->get('Historico',"CSolicitudes::historial");
    $routes->get('HistoricoAsignado',"CSolicitudes::historial_asignado");
    $routes->get('GetDetalles/(:num)',"CSolicitudes::detalles/$1");
    $routes->get('GetDetallesAsignado/(:num)',"CSolicitudes::detalles_asignado/$1");
    $routes->post('SaveSolicitud','CSolicitudes::save');


    //SolicitudesTripulacion
    $routes->get('SolicitudesTripulacion/(:num)','CSolicitudesTripulacion::index/$1');
    $routes->get('SolicitarTripulacion/','CSolicitudesTripulacion::solicitar');
    $routes->get('HistoricoTripulacion',"CSolicitudesTripulacion::historial");
    //$routes->get('HistoricoAsignado',"CSolicitudesTripulacion::historial_asignado");
    $routes->get('GetDetallesTripulacion/(:num)',"CSolicitudesTripulacion::detalles/$1");
    //$routes->get('GetDetallesAsignado/(:num)',"CSolicitudesTripulacion::detalles_asignado/$1");
    $routes->post('SaveSolicitudTripulacion','CSolicitudesTripulacion::save');
    $routes->get('EditSolicitudTripulacionv/(:num)', 'CSolicitudesTripulacion::edit/$1');
    $routes->post('UpdateSolicitudTripulacion','CSolicitudesTripulacion::update');
    $routes->get('DeleteSolicitudTripulacion/(:num)', 'CSolicitudesTripulacion::delete/$1');
    $routes->get('CancelarSolicitudTripulacion/(:num)','CSolicitudesTripulacion::cancelar/$1');
    $routes->get('AsignarMovilTripulacion/(:num)', 'CSolicitudesTripulacion::asignar/$1');
    $routes->post('ConfirmaAsignarMovilTripulacion','CSolicitudesTripulacion::asignar_confirmar');

    //SolicitudesVoucher
    $routes->get('SolicitudesVoucher/(:num)','CSolicitudesVoucher::index/$1');
    $routes->get('SolicitarVoucher/','CSolicitudesVoucher::solicitar');
    $routes->get('HistoricoVoucher',"CSolicitudesVoucher::historial");
    //$routes->get('HistoricoAsignadoVoucher',"CSolicitudesVoucher::historial_asignado");
    $routes->get('GetDetallesVoucher/(:num)',"CSolicitudesVoucher::detalles/$1");
    //$routes->get('GetDetallesAsignadoVoucher/(:num)',"CSolicitudesVoucher::detalles_asignado/$1");
    $routes->post('SaveSolicitudVoucher','CSolicitudesVoucher::save');
    $routes->get('EditSolicitudVoucher/(:num)', 'CSolicitudesVoucher::edit/$1');
    $routes->post('UpdateSolicitudVoucher','CSolicitudesVoucher::update');
    $routes->get('DeleteSolicitudVoucher/(:num)', 'CSolicitudesVoucher::delete/$1');
    $routes->get('CancelarSolicitudVoucher/(:num)','CSolicitudesVoucher::cancelar/$1');
    $routes->get('AsignarMovilVoucher/(:num)', 'CSolicitudesVoucher::asignar/$1');
    $routes->post('ConfirmaAsignarMovilVoucher','CSolicitudesVoucher::asignar_confirmar');
    
    

});

$routes->group('conductor', function($routes){

    $routes->get('dashboard', 'Home::dashboard_conductor');
    
    $routes->get('/', 'CPasajeros::dashboard');
    $routes->get('RutasPendientes','Home::dash_conductor');
    
    $routes->get('Solicitudes/(:num)','CSolicitudes::index/$1');
    $routes->get('Solicitar/','CSolicitudes::solicitar');
    $routes->get('Historico',"CSolicitudes::historial");
    $routes->get('HistoricoAsignado',"CSolicitudes::historial_asignado");
    $routes->get('GetDetalles/(:num)',"CSolicitudes::detalles/$1");
    $routes->get('GetDetallesAsignado/(:num)',"CSolicitudes::detalles_asignado/$1");
    $routes->post('SaveSolicitud','CSolicitudes::save');

     //SolicitudesTripulacion
     $routes->get('SolicitudesTripulacion/(:num)','CSolicitudesTripulacion::index/$1');
     $routes->get('SolicitarTripulacion/','CSolicitudesTripulacion::solicitar');
     $routes->get('HistoricoTripulacion',"CSolicitudesTripulacion::historial");
     //$routes->get('HistoricoAsignado',"CSolicitudesTripulacion::historial_asignado");
     $routes->get('GetDetallesTripulacion/(:num)',"CSolicitudesTripulacion::detalles/$1");
     //$routes->get('GetDetallesAsignado/(:num)',"CSolicitudesTripulacion::detalles_asignado/$1");
     $routes->post('SaveSolicitudTripulacion','CSolicitudesTripulacion::save');
     $routes->get('EditSolicitudTripulacionv/(:num)', 'CSolicitudesTripulacion::edit/$1');
     $routes->post('UpdateSolicitudTripulacion','CSolicitudesTripulacion::update');
     $routes->get('DeleteSolicitudTripulacion/(:num)', 'CSolicitudesTripulacion::delete/$1');
     $routes->get('CancelarSolicitudTripulacion/(:num)','CSolicitudesTripulacion::cancelar/$1');
     $routes->get('AsignarMovilTripulacion/(:num)', 'CSolicitudesTripulacion::asignar/$1');
     $routes->post('ConfirmaAsignarMovilTripulacion','CSolicitudesTripulacion::asignar_confirmar');

     
     $routes->get('ActualizarEstado/(:alpha)/(:num)/(:num)', 'CSolicitudes::actulizar_estado/$1/$2/$3');
     $routes->get('IniciarServicio/(:alpha)/(:num)', 'CSolicitudes::inicia_viaje/$1/$2');
     $routes->get('FinalizarServicio/(:alpha)/(:num)', 'CSolicitudes::finaliza_viaje/$1/$2');
     $routes->post('UpdateNovedad','CSolicitudes::novedad');   

 
     //SolicitudesVoucher
     $routes->get('SolicitudesVoucher/(:num)','CSolicitudesVoucher::index/$1');
     $routes->get('SolicitarVoucher/','CSolicitudesVoucher::solicitar');
     $routes->get('HistoricoVoucher',"CSolicitudesVoucher::historial");
     //$routes->get('HistoricoAsignadoVoucher',"CSolicitudesVoucher::historial_asignado");
     $routes->get('GetDetallesVoucher/(:num)',"CSolicitudesVoucher::detalles/$1");
     //$routes->get('GetDetallesAsignadoVoucher/(:num)',"CSolicitudesVoucher::detalles_asignado/$1");
     $routes->post('SaveSolicitudVoucher','CSolicitudesVoucher::save');
     $routes->get('EditSolicitudVoucher/(:num)', 'CSolicitudesVoucher::edit/$1');
     $routes->post('UpdateSolicitudVoucher','CSolicitudesVoucher::update');
     $routes->get('DeleteSolicitudVoucher/(:num)', 'CSolicitudesVoucher::delete/$1');
     $routes->get('CancelarSolicitudVoucher/(:num)','CSolicitudesVoucher::cancelar/$1');
     $routes->get('AsignarMovilVoucher/(:num)', 'CSolicitudesVoucher::asignar/$1');
     $routes->post('ConfirmaAsignarMovilVoucher','CSolicitudesVoucher::asignar_confirmar');
    
    //Rutas recogidas
     $routes->get('RutasRecogidas',"CRutasRecogidas::index");
     $routes->get('PasajerosRuta/(:num)/(:any)/(:any)', 'CRutasRecogidas::gestion_ruta_conductor/$1/$2/$3');
     $routes->post('AsignarMovilRuta', 'CRutasRecogidas::confirmar_ruta');
     $routes->get('IniciarRutaRecogida/(:num)/(:any)/(:any)', 'CRutasRecogidas::iniciar_ruta_conductor/$1/$2/$3');
     $routes->post('AsistenciaRutaRecogida', 'CRutasRecogidas::asistencia_ruta');
     
     
     //Rutas Reparto
     $routes->get('RutasReparto',"CRutasReparto::index");
     $routes->get('PasajerosRutaReparto/(:num)/(:any)/(:any)', 'CRutasReparto::gestion_ruta_conductor/$1/$2/$3');
     $routes->post('AsignarMovilRutaReparto', 'CRutasReparto::confirmar_ruta');
     $routes->get('IniciarRutaReparto/(:num)/(:any)/(:any)', 'CRutasReparto::iniciar_ruta_conductor/$1/$2/$3');
     $routes->post('AsistenciaRutaReparto', 'CRutasReparto::asistencia_ruta');   


});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
