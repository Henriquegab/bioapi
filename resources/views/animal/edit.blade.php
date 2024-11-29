@extends('adminlte::page')

@section('title', 'Editar animal')

@section('content_header')

@stop

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
        <li class="breadcrumb-item"><a href="{{ route('animalweb.index') }}">Animais</a></li>
        <li class="breadcrumb-item"><a>Edição de animal</a></li>
    </ol>
</nav>

{{-- Pesquisa de Animais --}}

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Pesquisar posts de animais cadastrados no sistema</h3>
    </div>
    <form id="form_id" method="post" action="{{ route('animalweb.update', $animal->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body row justify-content-around">
            <div class="col-md-4" style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                <a href="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" data-lightbox="animal-gallery">
                    <img src="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" alt="Animal" style="width: 100%; height: auto;">
                </a>

            </div>

            <div class="col col-md-8">
                <div class="col-md-12 form-group">
                    <label for="name">Titulo</label>
                    <input maxlength="200" type="search" class="form-control" name="titulo"
                        value="{{ $animal->titulo }}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Animal</label>
                    <input maxlength="200" type="search" class="form-control" name="animal"
                        value="{{ $animal->animal }}" required>
                </div>
                <div class="col-md-12 form-group">
                    <label for="name">Descrição</label>
                    <textarea rows="5" class="form-control" name="descricao"
                        readonly>{{ $animal->descricao }}</textarea>
                </div>
                <div class="col-md-12 form-group">
                    <button type="submit" class="btn btn-primary float-right text-nowrap"><i class="fa fa-save"></i>
                        Salvar</button>
                </div>



            </div>

        </div>






    </form>

</div>

@stop
