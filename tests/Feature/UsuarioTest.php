<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsuarioTest extends TestCase
{

    public function test_usuarios_get(): void
    {
        $response = $this->get('/api/v1/usuarios');
        $response->assertStatus(200);
    }

    public function test_usuario_post(): void
    {
        $response = $this->post('/api/v1/usuarios', [
            'nombres' => 'Test User',
            'apellidos' => 'Test User',
            'direccion' => 'Direccion',
            'telefono' => '123123123',
            'tipo' => '1',
        ]);
        $response->assertStatus(200);
    }

    public function test_usuario_update_put(): void
    {
        $response = $this->put('/api/v1/usuarios/4', [
            'nombres' => 'Test User',
            'apellidos' => 'Test User',
            'direccion' => 'Direccion',
            'telefono' => '123123123',
            'tipo' => '1',
        ]);
        $response->assertStatus(200);
    }

    public function test_usuario_show_get(): void
    {
        $response = $this->get('/api/v1/usuarios/4');
        $response->assertStatus(200);
    }

    public function test_usuario_delete(): void
    {
        $response = $this->delete('/api/v1/usuarios/4');
        $response->assertStatus(200);
    }
}
