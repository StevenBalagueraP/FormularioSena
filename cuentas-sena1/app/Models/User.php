<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;

/**
 * Modelo User - Representa la entidad de usuarios en el sistema
 */

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use Notifiable;

    /**
     * Atributos que pueden asignarse masivamente
     *
     * @var array<string> Lista de campos permitidos para asignación masiva
     */
    protected $fillable = [
        'usuario',
        'nombre',
        'apellido',
        'email',
        'telefono',
        'password',
    ];

    /**
     * Atributos ocultos en las respuestas
     *
     * @var array<string> Campos que no se muestran en serializaciones
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    

   /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail());
    }
}
