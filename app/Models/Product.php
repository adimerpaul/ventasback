<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "imagen",
        "color",
        "precio",
        "descripcion",
        "activo",
        "rubro_id",
    ];
    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }
}
