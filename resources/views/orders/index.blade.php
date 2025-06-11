@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <div class="card white darken-1">
                <div class="card-content black-text">
                    <span class="card-title">Bem-vindo!</span>
                    <p>Esta é a sua página inicial. Ela está estendendo o layout `app.blade.php` com a navbar Materialize.</p>
                    <p>Sinta-se à vontade para adicionar mais conteúdo aqui.</p>
                </div>
                <div class="card-action">
                    <a href="{{ url('/sobre') }}">Ir para a Página Sobre</a>
                    <a href="{{ url('/contato') }}">Entre em Contato</a>
                </div>
            </div>
        </div>
    </div>
@endsection