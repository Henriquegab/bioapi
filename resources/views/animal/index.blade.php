@extends('adminlte::page')

@section('title', 'Listagem de animais')

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
        <form id="form_id" action="{{ route('animalweb.index') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Titulo</label>
                        <input maxlength="200" type="search" class="form-control" name="titulo"
                            value="{{ request()->titulo ?? '' }}" placeholder="ex.: Leão encontrado na selva">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="name">Animal</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ request()->animal ?? '' }}" placeholder="ex.: Leão">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="name">Status</label>
                        <select class="custom-select"
                            id="tipo" name="tipo">
                            <option disabled selected value="">Selecione o tipo de status</option>
                            <option value="0" {{ old('tipo') === 0 ? 'selected' : '' }}>Não publicado (as)
                            </option>
                            <option value="1" {{ old('tipo') === 'Publicado' ? 'selected' : '' }}>Publicado</option>

                        </select>
                    </div>


                </div>
            </div>

            <div class="pb-4 d-flex align-items-center justify-content-end table-responsive">
                <div class="btn-group ">

                    <button type="submit" class="btn btn-dark float-right text-nowrap"><i class="fa fa-search"></i>
                        Pesquisar</button>
                    <a href="{{ route('animalweb.index') }}" class="btn btn-outline-primary text-nowrap mr-4"><i
                            class="fa fa-eraser "></i> Limpar busca</a>

                </div>
            </div>

        </form>

    </div>

    <div class="card card-dark card-outline">

        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Titulo</th>
                        <th>Animal</th>
                        <th>Criado por</th>
                        <th>Criado em</th>
                        <th>Status</th>

                        <th class="col-1">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($animais as $animal)
                        <tr>
                            <td>{{ $animal->id }}</td>
                            <td>{{ $animal->titulo }}</td>
                            <td>{{ $animal->animal }}</td>
                            <td>{{ $animal->user->name }}</td>
                            <td>{{ $animal->created_at->isoFormat('D [de] MMMM [de] YYYY, H\hmm') }}</td>
                            <td>

                                @if($animal->publicado == 0)
                                     <span class="badge badge-warning">Não publicado</span>
                                @else
                                    <span class="badge badge-success">Publicado</span>
                                @endif

                                {{-- {{ $animal->publicado == 0 ? 'não publicado' :  }}</td> --}}

                            <td>

                                <div class="btn-group">
                                    {{-- @can('Visualizar animais') --}}
                                        <a class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ver"
                                            href="{{ route('animalweb.show', $animal->id) }}">
                                            <i class="fa fa-fw fa-eye"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('Editar animais') --}}
                                            <a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"
                                                href="{{ route('animalweb.edit', $animal->id) }}">
                                                <i class="fa fa-fw fa-pen"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('Excluir animais') --}}
                                            <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"
                                                href="{{ route('animalweb.destroy', $animal->id) }}">
                                                <i class="fa fa-fw fa-trash"></i></a>
                                    {{-- @endcan --}}
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($animais->hasPages() != false)
            <div class="card-footer clearfix" style="padding-bottom: 0px;" ;>
                {{ $animais->links() }}
            </div>
        @endif

    @stop
