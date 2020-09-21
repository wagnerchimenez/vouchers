<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientes_id', 'ofertas_id', 'hash', 'expira_em', 'utilizado_em'
    ];

    public function cliente()
    {
        return $this->belongsTo('\App\Models\Cliente', 'clientes_id');
    }

    public function oferta()
    {
        return $this->belongsTo('\App\Models\Oferta', 'ofertas_id');
    }
}
