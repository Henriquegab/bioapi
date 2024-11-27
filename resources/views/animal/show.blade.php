@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
        <li class="breadcrumb-item"><a href="{{ route('animalweb.index') }}">Animais</a></li>
    </ol>
</nav>

{{-- Pesquisa de Animais --}}

<div class="card card-dark">
    <div class="card-header">
        <h3 class="card-title">Pesquisar posts de animais cadastrados no sistema</h3>
    </div>
    {{-- <form id="form_id" action="{{ route('animalweb.index') }}">
        @csrf --}}
        <div class="card-body row justify-content-around">
            <div class="border col-md-4" style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                <a href="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" data-lightbox="animal-gallery">
                    <img src="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" alt="Animal" style="width: 100%; height: auto;">
                </a>

            </div>

            <div class="row col-md-8">
                <div class="col-md-4 form-group">
                    <label for="name">Titulo</label>
                    <input maxlength="200" type="search" class="form-control" name="titulo"
                        value="{{ $animal->titulo }}" readonly>
                </div>
                <div class="col-md-3 form-group">
                    <label for="name">Animal</label>
                    <input maxlength="200" type="search" class="form-control" name="animal"
                        value="{{ $animal->animal }}" readonly>
                </div>
                <div class="col-md-5 form-group">
                    <label for="name">Descrição</label>
                    <textarea class="form-control" name="descricao"
                        readonly>{{ public_path().'/'.$animal->imagem->first()->caminho }}</textarea>
                </div>
                {{-- <div class="col-md-3 form-group">
                    <label for="name">Status</label>
                    <select class="custom-select"
                        id="tipo" name="tipo">
                        <option disabled selected value="">Selecione o tipo de status</option>
                        <option value="0" {{ old('tipo') === 0 ? 'selected' : '' }}>Não publicado (as)
                        </option>
                        <option value="1" {{ old('tipo') === 'Publicado' ? 'selected' : '' }}>Publicado</option>

                    </select>
                </div> --}}


            </div>
        </div>

        {{-- <div class="pb-4 d-flex align-items-center justify-content-end table-responsive">
            <div class="btn-group ">

                <button type="submit" class="btn btn-dark float-right text-nowrap"><i class="fa fa-search"></i>
                    Pesquisar</button>
                <a href="{{ route('animalweb.index') }}" class="btn btn-outline-primary text-nowrap mr-4"><i
                        class="fa fa-eraser "></i> Limpar busca</a>

            </div>
        </div> --}}

    {{-- </form> --}}

</div>

@stop
