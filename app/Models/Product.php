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
        "cantidad",
        "rubro_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
    public function rubro(){
        return $this->belongsTo(Rubro::class);
    }
}
