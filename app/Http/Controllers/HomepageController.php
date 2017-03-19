<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\Aviso;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HomepageController extends Controller
{
    /**
     * Recibe petición GET a '/'
     * Retorna la paǵina principal de Socialbook
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index(){
    	//$institucion = Institucion::where('nombre','Comedor San Antonio')->first();
    	$instituciones = Controller::listado_instituciones();
    	$avisos = Aviso::orderBy('created_at', 'desc')->paginate(6);
    	foreach ($avisos as $key => $aviso) {
    		foreach ($instituciones as $key => $institucion) {
    			if ($aviso->rut_inst == $institucion->rut_inst) {
    				$aviso['nom_institucion'] = $institucion->nom_institucion;
    			}
    		}
    	}
    	return view('homepage',compact('instituciones', 'avisos'));

    }

}
