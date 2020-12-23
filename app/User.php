<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombres',
        'apellidos',
        'tipo_documento_persona_id',
        'numero_documento',
        'usuario',
        'password',
        'email',
        'estado',
        'usuario_creacion',
        'usuario_actualizacion'
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

        /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function documento()
    {
        return $this->belongsTo('App\TipoDocumentoPersona', 'tipo_documento_persona_id', 'id');
    }

    public function creacion()
    {
        return $this->belongsTo('App\User', 'usuario_creacion', 'id');
    }

    public function actualizacion()
    {
        return $this->belongsTo('App\User', 'usuario_actualizacion');
    }

    public function creacionArchivos()
    {
        return $this->hasMany('App\Archivo', 'usuario_creacion');
    }

    public function actualizacionArchivos()
    {
        return $this->hasMany('App\Archivo', 'usuario_actualizacion');
    }

    public function creacionActividadEconomicas()
    {
        return $this->hasMany('App\DetalleActividadEconomica', 'usuario_creacion');
    }

    public function actualizacionActividadEconomicas()
    {
        return $this->hasMany('App\DetalleActividadEconomica', 'usuario_actualizacion');
    }

    public function creacionCategoriaContactos()
    {
        return $this->hasMany('App\DetalleCategoriaContacto', 'usuario_creacion');
    }

    public function actualizacionCategoriaContactos()
    {
        return $this->hasMany('App\DetalleCategoriaContacto', 'usuario_actualizacion');
    }

    public function creacionFinancieras()
    {
        return $this->hasMany('App\InformacionFinanciera', 'usuario_creacion');
    }

    public function actualizacionFinancieras()
    {
        return $this->hasMany('App\InformacionFinanciera', 'usuario_actualizacion');
    }

    public function creacionOficinas()
    {
        return $this->hasMany('App\Oficina', 'usuario_creacion');
    }

    public function actualizacionOficinas()
    {
        return $this->hasMany('App\Oficina', 'usuario_actualizacion');
    }

    public function creacionOrganizacions()
    {
        return $this->hasMany('App\Organizacion', 'usuario_creacion');
    }

    public function actualizacionOrganizacions()
    {
        return $this->hasMany('App\Organizacion', 'usuario_actualizacion');
    }

    public function creacionTareas()
    {
        return $this->hasMany('App\Tarea', 'usuario_creacion');
    }

    public function actualizacionTareas()
    {
        return $this->hasMany('App\Tarea', 'usuario_actualizacion');
    }

    public function creacionVisitas()
    {
        return $this->hasMany('App\Visita', 'usuario_creacion');
    }

    public function actualizacionVisitas()
    {
        return $this->hasMany('App\Visita', 'usuario_actualizacion');
    }
}
