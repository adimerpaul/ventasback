<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable=[
        "cantidad",
        "nombreproducto",
        "precio",
        "subtotal",
        "tarjeta",
        "credito",
        "sale_id",
        "user_id",
        "producto_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
}
