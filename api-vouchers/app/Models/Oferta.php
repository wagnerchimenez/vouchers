<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'desconto'
    ];

    public function vouchers()
    {
        return $this->hasMany('\App\Models\Voucher', 'ofertas_id');
    }
}
