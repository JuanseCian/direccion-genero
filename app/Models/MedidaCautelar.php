<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedidaCautelar extends Model
{
    use HasFactory;

    protected $table = 'medidas_cautelares';
    public $timestamps = false;

    protected $fillable = ['nombre'];
}