@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="col-md-12 display-4 text-center mb-5">Minhas Notas</h1>

        @if (!$notas->isEmpty())
            @foreach ($notas as $nota)           
            <div class="col-md-4">
                <div class="card text-center shadow mb-5">
                    <a href="{{ route('notas.show', $nota->id) }}" class="text-reset text-decoration-none">
                        <div class="card-body">                            
                            <h5 class="card-title text-truncate mt-5">{{ $nota->title }}</h5>
                            <p class="card-text text-truncate">{{ $nota->text }}</p>
                            @if (isset($nota->created_at))
                                <p class="card-text mb-3"><small class="text-muted">Criado em {{ $nota->created_at->format('d/m/Y') }}</small></p>
                            @endif

                            @if ($nota->is_public == 1)
                                <p class="card-text mb-3 text-right"><small class="text-success"><strong>Público</strong></small></p>
                            @else
                                <p class="card-text mb-3 text-right"><small class="text-danger"><strong>Privado</strong></small></p>
                            @endif
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        @else
            <div class="col-md-4">
                <div class="card text-center shadow mb-5">
                    <div class="card-body">                            
                        <h5 class="card-title">Ah não, você não possui nenhuma nota...</h5>
                        <button type="button" data-toggle="modal" data-target="#newNote" class="btn btn-primary btn-sm">Criar minha primeira nota</button>
                    </div>
                </div>            
            </div>
        @endif
    </div>
</div>
@endsection