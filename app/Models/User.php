<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\IveCaso;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'nombre',
        'apellido',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function username()
    {
        return 'username';
    }
    public function iveCasos()
{
    return $this->belongsToMany(
        IveCaso::class,
        'ive_caso_user',
        'user_id',
        'ive_caso_id'
    );
}
    public function rol()
    {
        return $this->belongsTo(Role::class,'rol_id');
    }

    public function esAdmin()
    {
        return $this->rol_id == 2;
    }

    public function tieneArea($areaNombre)
    {
        if ($this->esAdmin()) {
            return true;
        }

        return $this->areas()->where('nombre',$areaNombre)->exists();
    }

    public function esProgramador()
    {
        return $this->rol_id == 4;
    }

    public function estaActivo()
    {
        return $this->rol_id != 3;
    }
    
    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }
}
