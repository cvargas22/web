<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'rut_inst'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Indica que User puede tener muchos aviso
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function aviso()
    {
        return $this->hasMany('aviso');
    }

    /**
     * Indica que User pertenece a una institucion
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public function institucion()
    {
        return $this->belongsTo('institucion');
    }
}
