<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome', 'email'
    ];

    public function vouchers()
    {
        return $this->hasMany('\App\Models\Voucher', 'clientes_id');
    }

}
