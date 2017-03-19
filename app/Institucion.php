<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    protected $table = 'institucion';
    protected $fillable = ['rut_inst',
		'mision',
		'vision',
		'nombre',
		'direccion',
		'telefono',
		'mail'];


    /**
     * Indica que una Institución puede tener muchos aviso
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function aviso() {
    	return $this->hasMany('aviso');

    }

    /**
     * Indica que una Institución puede tener muchos user
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function user() {
    	return $this->hasMany('user');

    }
}
