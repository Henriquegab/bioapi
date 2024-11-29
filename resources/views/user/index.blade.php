@extends('adminlte::page')

@section('title', 'Gerenciamento de usuários')

@section('content_header')

@stop

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
            <li class="breadcrumb-item"><a href="{{ route('userweb.index') }}">Usuários</a></li>
        </ol>
    </nav>

    {{-- Pesquisa de Animais --}}

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Pesquisar usuários cadastrados no sistema</h3>
        </div>
        <form id="form_id" action="{{ route('userweb.index') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Titulo</label>
                        <input maxlength="200" type="search" class="form-control" name="titulo"
                            value="{{ request()->titulo ?? '' }}" placeholder="ex.: Leão encontrado na selva">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">user</label>
                        <input maxlength="200" type="search" class="form-control" name="user"
                            value="{{ request()->user ?? '' }}" placeholder="ex.: Leão">
                    </div>



                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Criado por</label>
                        <input maxlength="200" type="search" class="form-control" name="titulo"
                            value="{{ request()->titulo ?? '' }}" placeholder="ex.: Leão encontrado na selva">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="publicado">Status</label>
                        <select class="custom-select" id="publicado" name="publicado">
                            <option disabled {{ request()->publicado === null ? 'selected' : '' }} value="">Selecione o tipo de status</option>
                            <option value="0" {{ request()->publicado === "0" ? 'selected' : '' }}>Não publicado</option>
                            <option value="1" {{ request()->publicado === "1" ? 'selected' : '' }}>Publicado</option>
                        </select>

                    </div>
                    {{-- <div class="col-md-3 form-group">

                        <div class="btn-group ">

                            <button type="submit" class="btn btn-primary float-right text-nowrap"><i class="fa fa-search"></i>
                                Pesquisar</button>
                            <a href="{{ route('userweb.index') }}" class="btn btn-outline-primary text-nowrap mr-4"><i
                                    class="fa fa-eraser "></i> Limpar busca</a>

                        </div>

                    </div> --}}


                </div>
            </div>

            <div class="pb-4 d-flex align-items-center justify-content-end table-responsive">
                <div class="btn-group ">

                    <button type="submit" class="btn btn-primary float-right text-nowrap"><i class="fa fa-search"></i>
                        Pesquisar</button>
                    <a href="{{ route('userweb.index') }}" class="btn btn-outline-primary text-nowrap mr-4"><i
                            class="fa fa-eraser "></i> Limpar busca</a>

                </div>
            </div>

        </form>

    </div>

    <div class="card card-primary card-outline">

        <div class="card-body table-responsive p-0">
            <table class="table table-bordered table-striped dataTable dtr-inline">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Criado em</th>
                        <th>Cargo</th>

                        <th class="col-1">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->isoFormat('D [de] MMMM [de] YYYY, H\hmm') }}</td>
                            <td>

                                {{ $user->roles->first()->name }}

                            <td>

                                <div class="btn-group">
                                    {{-- @can('Visualizar animais') --}}
                                        <a class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Ver"
                                            href="{{ route('userweb.show', $user->id) }}">
                                            <i class="fa fa-fw fa-eye"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('Editar animais') --}}
                                            <a class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Editar"
                                                href="{{ route('userweb.edit', $user->id) }}">
                                                <i class="fa fa-fw fa-pen"></i></a>
                                    {{-- @endcan --}}
                                    {{-- @can('Excluir animais') --}}
                                            <a class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Excluir"
                                                href="{{ route('userweb.destroy', $user->id) }}">
                                                <i class="fa fa-fw fa-trash"></i></a>
                                    {{-- @endcan --}}
                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- @if ($users->hasPages() != false)
            <div class="card-footer clearfix" style="padding-bottom: 0px;" ;>
                {{ $users->links() }}
            </div>
        @endif --}}

    @stop
