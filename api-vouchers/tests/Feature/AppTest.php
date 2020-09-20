<?php

namespace Tests\Feature;

use Tests\TestCase;

class AppTest extends TestCase
{
    public function testListarClientes()
    {

        $this->get(route('clientes.index'))
            ->assertStatus(200);
    }

    public function testListarOfertas()
    {

        $this->get(route('ofertas.index'))
            ->assertStatus(200);
    }

    public function testListarVouchers()
    {

        $this->get(route('vouchers.index'))
            ->assertStatus(200);
    }
}
