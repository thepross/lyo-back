<?php

namespace Tests\Feature;

use App\Models\Usuario;
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
        $data = Usuario::factory()->make()->toArray();

        $response = $this->post('/api/v1/usuarios', $data);
        
        $response->assertStatus(200);
    }

    public function test_usuario_update_put(): void
    {
        $data = Usuario::factory()->create();
        $response = $this->put('/api/v1/usuarios/' . $data->id, [
            'nombres' => 'Test User2',
            'apellidos' => 'Test User2',
            'direccion' => 'Direccion2',
            'telefono' => '12312334',
            'tipo' => '1',
        ]);
        $response->assertStatus(200);
    }

    // public function test_usuario_show_get(): void
    // {
    //     $response = $this->get('/api/v1/usuarios/4');
    //     $response->assertStatus(200);
    // }

    // public function test_usuario_delete(): void
    // {
    //     $response = $this->delete('/api/v1/usuarios/4');
    //     $response->assertStatus(200);
    // }
}
