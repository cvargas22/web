<?php

namespace App\Http\Controllers;

use App\Institucion;
use App\Aviso;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    public function listado_instituciones(){
    	$instituciones = Institucion::all();
    	foreach ($instituciones as $key => $institucion) {
			$nom_institucion = $institucion->nombre;
			$nom_institucion = str_replace(" ", "_", $nom_institucion);
			$institucion['nom_institucion'] = $nom_institucion;
		}
    	return $instituciones;
    }
}
