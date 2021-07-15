<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logproducto extends Model
{
    use HasFactory;
    protected $fillable=[
        "cantidad",
        "fecha",
        "product_id",
        "user_id",
    ];
    protected $hidden = ["created_at", "updated_at"];
}
