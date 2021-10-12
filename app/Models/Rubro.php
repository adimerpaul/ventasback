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
    protected $hidden = ["created_at", "updated_at"];
    public function products(){
        return $this->hasMany(Product::class)->where('activo',1);
    }
}
