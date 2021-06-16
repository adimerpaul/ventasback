<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubro extends Model
{
    use HasFactory;
    protected $fillable=[
        "nombre",
        "imagen",
        "color",
        "activo",
    ];
    public function products(){
        return $this->hasMany(Product::class);
    }
}
