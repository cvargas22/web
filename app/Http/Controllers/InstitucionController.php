<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Institucion;
use App\Aviso;

class InstitucionController extends Controller
{
    /**
     * Recibe petición GET a '/institucion/{institucion?}'
     * Retorna la vista con toda la información de la institución solicitada
     *
     * @param      <type>  $institucion  El nombre de la institución solicitada
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index($institucion)
    {
    	$institucion_conEspacios  = str_replace("_"," ",$institucion);
    	$institucion = Institucion::where('nombre',$institucion_conEspacios)->first();
    	$instituciones = Controller::listado_instituciones();
    	return view('institucion',compact('institucion', 'instituciones'));  
    }


    /**
     * Recibe petición GET a '/institucion/{institucion?}/aviso/{aviso?}'
     * Busca el aviso y si es que este pertenece a la institución que se pide
     * Si está bien. retorna la vista que muestra información del aviso solicitado
     * Sino, retorna una vista de error (por ahora)
     *
     * @param      <type>  $institucion  The institucion
     * @param      <type>  $aviso        The aviso
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function verAviso($institucion,$aviso){
        $aux = $institucion;
        $institucion_conEspacios  = str_replace("_"," ",$institucion);
        $institucion = Institucion::where('nombre',$institucion_conEspacios)->first();
        $aviso = Aviso::where('id',$aviso)->where('rut_inst',$institucion->rut_inst)->first();
        if ($aviso) {
            $instituciones = Controller::listado_instituciones();
            return view('verAviso',compact('institucion', 'instituciones', 'aviso', 'aux'));  
        }
        else{
            return view('errors/503');
        }
        
    }
}
