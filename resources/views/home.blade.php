@extends('layouts.app')

@section('content')

<div class="content">
    <div class="title">
        Anotaí
    </div>
    <div class="m-b-lg">
        <blockquote class="blockquote">
            <p class="mb-0 h2">Seu app de notas fácil, rápido e seguro!</p>
        </blockquote>
        
    </div>

    <div class="mt-5">
        @if (Auth::check())
        <a href="{{ route('notas.index') }}" class="btn btn-outline-primary btn-lg my-1">MINHAS NOTA</a>
        <button type="button" class="btn btn-outline-primary btn-lg mx-5 my-2" data-toggle="modal" data-target="#newNote">CRIAR UMA NOTA</button>
        @else
        <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg m-5">CRIAR UMA NOTA</a>
        @endif
        <span class="lead"> É rápido, e grátis :)</span>
    </div>
</div>

@endsection
