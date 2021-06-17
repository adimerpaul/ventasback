<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosage extends Model
{
    use HasFactory;
    protected $fillable=[
        'nrotramite',
        'nroautorizacion',
        'nrofactini',
        'llave',
        'desde',
        'hasta',
        'leyenda',
        'activo',
        'nrofactura',
        'empresa_id'
    ];
    protected $hidden = ["created_at", "updated_at"];
    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }
}
