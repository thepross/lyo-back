<?php
use App\Models\User;
use App\Models\Rol;

// $usuario = User::first()->usuario;
// $rol = User::first()->rol;
// dd($rol);

$rol = Rol::first();
dd($rol->users);