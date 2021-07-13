<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $fillable=[
        "fecha",
        "total",
        "tipo",
        "codigocontrol",
        "codigoqr",
        "delivery",
        "estado",
        "nrocomprobante",
        "monto",
        "user_id",
        "dosage_id",
        "client_id",
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function details(){
        return $this->hasMany(Detail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }
    public function dosage(){
        return $this->belongsTo(Dosage::class)->with('empresa');
    }
}
