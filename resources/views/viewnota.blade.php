@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12  text-center mb-5">
        <h1 class="display-4">Nota de {{ $user->name }}</h1>
            @auth
                <p><a href="{{route('notas.index')}}">< voltar</a></p>
            @endauth
            
        </div>        
        <div class="col-md-6">
            <div class="card text-center shadow mb-5">
                @auth
                <div class="text-right pr-3 pt-2">                    
                    <button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#deleteNote">
                        <img src="{{ asset('icons/x.svg') }}" alt="" width="25" height="25" title="Deletar">
                    </button>
                    <button type="button" class="close" aria-label="Close" data-toggle="modal" data-target="#editNote">
                        <img src="{{ asset('icons/pencil.svg') }}" alt="" width="20" height="20" title="Editar">
                    </button>
                </div>
                @endauth
                <div class="card-body">
                    @if ($nota->is_public == 1 || $user_logged == $nota->user_id)
                        <h5 class="card-title">{{ $nota->title }}</h5>
                        <p class="card-text">{{ $nota->text }}</p>
                        @if (isset($nota->created_at))
                            <p class="card-text mb-3"><small class="text-muted">Criado em {{ $nota->created_at->format('d/m/Y') }}</small></p>
                        @endif
                        @if ($nota->is_public == 1)
                                <p class="card-text mb-3 text-right"><small class="text-success"><strong>Público</strong></small></p>
                            @else
                                <p class="card-text mb-3 text-right"><small class="text-danger"><strong>Privado</strong></small></p>
                        @endif
                    @else
                        <p class="card-text">Desculpe...</p>
                        <h2>Esta Nota é privada :(</h2>
                    @endif
                </div>
            </div>            
        </div>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="deleteNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Deletar nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body text-center">
            <h4 class="mb-3">Tem certeza que deseja deletar a nota "<strong>{{ $nota->title }}</strong>" ?</h4>
        <form method="post" action="{{ route('notas.destroy', $nota->id) }}">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-danger">Deletar</button>     
        </form>
        </div>
    </div>
    </div>
</div>



<!-- Modal Edit -->
<div class="modal fade" id="editNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Editar nota</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <form method="post" action="{{ route('notas.update', $nota->id) }}">
            @csrf
            @method('PUT')
            <div class="input-group flex-nowrap mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="addon-wrapping">Título</span>
                </div>
            <input type="text" name="title" class="form-control" placeholder="Insira o título da nota" aria-label="Username" aria-describedby="addon-wrapping" value="{{ $nota->title }}">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="text" placeholder="Sua nota...">{{ $nota->text }}</textarea>
            </div>
            <div class="input-group mb-5">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Visibilidade</label>
                </div>
                <select class="custom-select" name="is_public">
                    <option value="0" {{ $isPrivate }} >Privado</option>
                    <option value="1" {{ $isPublic }} >Público</option>
                </select>
            </div>            
                           
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Atualizar</button>     
        </form>
        </div>
    </div>
    </div>
</div>
@endsection