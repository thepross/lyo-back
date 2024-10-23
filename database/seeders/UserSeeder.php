<?php

namespace Database\Seeders;

use App\Models\Billetera;
use App\Models\Rol;
use App\Models\User;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rol::insert([
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Administracion total'
            ]
        ]);
        Rol::insert([
            [
                'nombre' => 'Cliente',
                'descripcion' => 'Cliente normal'
            ]
        ]);

        Usuario::insert([
            [
                'nombres' => 'boris',
                'apellidos' => 'calderon',
                'direccion' => 'flamingo',
                'telefono' => '75368102',
                'tipo' => '1',
            ]
        ]);
        User::insert([
            [
                'username' => 'boris',
                'email' => 'boris@lyo.com',
                'password' => Hash::make('password'),
                'id_usuario' => 1,
                'id_rol' => 1,
            ],
        ]);
        Usuario::insert([
            [
                'nombres' => 'adm',
                'apellidos' => 'adm',
                'direccion' => 'adm',
                'telefono' => '0000000',
                'tipo' => '1',
            ]
        ]);
        User::insert([
            [
                'username' => 'adm',
                'email' => 'adm@lyo.com',
                'password' => Hash::make('adm'),
                'id_usuario' => 2,
                'id_rol' => 1,
            ],
        ]);
        Billetera::insert([
            [
                'id' => Str::uuid(),
                'detalle' => 'adm',
                'fecha' => date("Y-m-d H:i:s"),
                'saldo' => 100000.00,
                'id_usuario' => 2
            ]
        ]);
        
    }
}
