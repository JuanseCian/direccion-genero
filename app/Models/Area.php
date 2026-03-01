<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    protected $fillable = ['nombre'];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function encargados()
    {
        return $this->belongsToMany(
            Encargado::class,
            'encargado_area',
            'area_id',
            'encargado_id'
        );
    }
}