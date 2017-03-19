<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Institucion;
use App\Aviso;
use App\User;
use Validator;
use Response;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Middleware para otorgar acceso solo a un usuario autenticado
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Revisa si el usuario actual está autenticado
     * Devuelve un objeto con el usuario logueado y otro de su institución correspondiente
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function index()
    {
        if (Auth::check())
        {
            // El usuario está autenticado
            $user = Auth::user();
            $institucion = Institucion::where('rut_inst',$user->rut_inst)->first();
            $instituciones = Controller::listado_instituciones();
            foreach ($instituciones as $key => $institucion) {
                if ($user->rut_inst == $institucion->rut_inst) {
                    $user_inst = $institucion;
                    $user_inst['nom_institucion'] = $institucion->nom_institucion;
                }
            }
            return [$user, $user_inst];
        }
    }


    /**
     * Recibe petición GET a '/dashboard/informacionInstitucional'
     * Retorna la vista para editar la información institucional en el dashboard
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function informacionInstitucional(){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        return view('informacionInstitucional',compact('user', 'user_inst'));
    }

    /**
     * Recibe petición POST a '/dashboard/informacionInstitucional'
     * Recibe formulario vía AJAX y lo valida con Validator
     * Si encuentra errores, devuelve una lista de errores para mostrarlos en la vista
     * Sino, obtiene la institución y actualiza los datos
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function editarInformacionInstitucional(Request $request){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];

        $v = Validator::make($request->all(),[
            'nombre' => 'required',
            'direccion' => 'required',
            'mision' => 'required',
            'vision' => 'required',
            'telefono' => 'required',
            'mail' => 'required',
        ]);

        if ($v->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()

            ), 400);
        }
        else{
            try {
                $institucion = Institucion::where('rut_inst',$user_inst->rut_inst)->first();
                $institucion->nombre = $request->nombre;
                $institucion->direccion = $request->direccion;
                $institucion->mision = $request->mision;
                $institucion->vision = $request->vision;
                $institucion->telefono = $request->telefono;
                $institucion->mail = $request->mail;
                $institucion->save();
                return Response::json(array('success' => true, 'msg' => "Institución editada correctamente"), 200); //200 = Ok
            } catch (Exception $e) {
                return Response::json(array('success' => false, 'msg' => "Error al editar institución"), 400); //400 = bad request
            }
        }
    }

    /**
     * Recibe petición GET a '/dashboard/nuevoAviso'
     * Retorna la vista con el formulario para crear un nuevo aviso
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function nuevoAviso(){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        return view('nuevoAviso',compact('user', 'user_inst'));
    }

    /**
     * Recibe petición POST a '/dashboard/nuevoAviso'
     * Recibe formulario vía AJAX y lo valida con Validator
     * Si encuentra errores, devuelve una lista de errores para mostrarlos en la vista
     * Sino, crea el nuevo aviso y lo guarda en BD
     * 
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function guardarNuevoAviso(Request $request){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];

        $v = Validator::make($request->all(),[
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        if ($v->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()

            ), 400);
        }
        else{ 
            try {
                $aviso = new Aviso;
                $aviso->titulo = $request->input('titulo');
                $aviso->descripcion = $request->input('descripcion');
                $aviso->img = "imagen";
                $aviso->rut_inst = $user_inst->rut_inst;
                $aviso->user_id = $user->id;
                $aviso->save();
                return Response::json(array('success' => true, 'msg' => "Aviso creado correctamente"), 200); //200 = Ok
                
            } catch (Exception $e) {
                return Response::json(array('success' => false, 'msg' => "Error al crear aviso"), 400); //400 = bad request
            }
            
        }
    }



    /**
     * Recibe petición GET a '/dashboard/listaAvisos'
     * Retorna la vista con los avisos de la institución, ordenados según más reciente de a 6 por página
     * 
     * @return     <type>  ( description_of_the_return_value )
     */
    public function listaAvisos(){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        $instituciones = Controller::listado_instituciones();

        $avisos = Aviso::where('rut_inst',$user->rut_inst)->orderBy('created_at', 'desc')->paginate(6);
        foreach ($avisos as $key => $aviso) {
            foreach ($instituciones as $key => $institucion) {
                if ($aviso->rut_inst == $institucion->rut_inst) {
                    $aviso['nom_institucion'] = $institucion->nom_institucion;
                }
            }
        }
        return view('listaAvisos',compact('user', 'user_inst', 'avisos'));
    }


    /**
     * Recibe petición POST a '/dashboard/listaAvisos/eliminarAviso'
     * Recibe la 'id' del aviso vía AJAX
     * Verifica que el aviso corresponda a un aviso del usuario logueado y lo borra
     *
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function eliminarAviso(Request $request){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        
        try {
            $aviso = Aviso::where('id',$request->id)->where('rut_inst',$user_inst->rut_inst);
            $aviso->delete();
            return Response::json(array('success' => true, 'msg' => "Aviso eliminado correctamente"), 200); //200 = Ok
        } catch (Exception $e) {
            return Response::json(array('success' => false, 'msg' => "Error al eliminar aviso"), 400); //400 = bad request
        }
        
    }



    /**
     * Recibe petición GET a 'dashboard/institucion/{institucion?}/aviso/{aviso?}'
     * Retorna la vista con el formulario para editar el aviso
     *
     * @param      <type>  $institucion  El nombre de la institución dueña del aviso
     * @param      <type>  $aviso        EL ID del aviso
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function editarAviso($institucion,$aviso){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        $aviso = Aviso::where('id',$aviso)->where('rut_inst',$user_inst->rut_inst)->first();
        if ($aviso) {
            return view('editarAviso',compact('user', 'user_inst','aviso'));
        }
        else{
            return view('errors/503');
        }
        
    }


    /**
     * Recibe petición POST a 'dashboard/institucion/{institucion?}/aviso/{aviso?}'
     * Recibe formulario vía AJAX y lo valida con Validator
     * Si encuentra errores, devuelve una lista de errores para mostrarlos en la vista
     * Sino, busca el aviso y verifica que corresponda al usuario logueado
     * Guarda el aviso modificado
     * 
     * @param      \Illuminate\Http\Request  $request  The request
     *
     * @return     <type>                    ( description_of_the_return_value )
     */
    public function guardarEditarAviso(Request $request){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];

        $v = Validator::make($request->all(),[
            'titulo' => 'required',
            'descripcion' => 'required',
        ]);

        if ($v->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $v->getMessageBag()->toArray()

            ), 400);
        }
        else{
            try {
                $aviso = Aviso::where('id',$request->id)->where('rut_inst',$user_inst->rut_inst)->first();
                $aviso->titulo = $request->titulo;
                $aviso->descripcion = $request->descripcion;
                $aviso->save();
                return Response::json(array('success' => true, 'msg' => "Aviso editado correctamente"), 200); //200 = Ok
            } catch (Exception $e) {
                return Response::json(array('success' => false, 'msg' => "Error al editar aviso"), 400); //400 = bad request
            }
        }
    }

    /**
     * Recibe petición GET a '/dashboard/estadisticas'
     * Retorna la vista con estadísticas falsas (por ahora)
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function estadisticas(){
        $elements = HomeController::index();
        $user = $elements[0];
        $user_inst = $elements[1];
        return view('estadisticas',compact('user', 'user_inst'));
    }

}
