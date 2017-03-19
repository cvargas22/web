<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aviso extends Model
{
    protected $table = 'aviso';

    protected $fillable = ['descripcion', 'titulo', 'img', 'rut_inst', 'user_id'];

    /**
     * Indica que un Aviso pertenece a una Institucion
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function institucion()
    {
        return $this->belongsTo('Institucion');
    }

    /**
     * Indica que un Aviso pertenece a un User
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function user()
    {
    	return $this->belongsTo('User');
    }
}
