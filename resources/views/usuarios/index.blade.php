@extends('layouts.principal')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                este es el body
                @foreach ($usuarios as $usuario)
                    <h1>{{ $usuario->id }}</h1>
                @endforeach
            </div>

        </div>
    </div>
@endsection
