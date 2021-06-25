<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anulado extends Model
{
    use HasFactory;
    protected $fillable=[
        "motivo",
        "fecha",
        "user_id",
        "sale_id",
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
