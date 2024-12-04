@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

<link href="resources/css/lightbox.css" rel="stylesheet" />
<script src="resources/js/lightbox-plus-jquery.js"></script>

@stop

@section('content')


<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
        <li class="breadcrumb-item"><a href="{{ route('animalweb.index') }}">Animais</a></li>
    </ol>
</nav>

{{-- Pesquisa de Animais --}}

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Pesquisar posts de animais cadastrados no sistema</h3>
    </div>
    {{-- <form id="form_id" action="{{ route('animalweb.index') }}">
        @csrf --}}
        <div class="card-body row justify-content-around">
            <div class="col-md-5" style="position: relative; overflow: hidden; width: 100%; height: 100%;">
                <div class="elevation-2">
                    {{-- <a href="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" data-lightbox="animal-gallery " >
                        <img src="{{ asset('storage/'.$animal->imagem->first()->caminho) }}" alt="Animal" style="width: 100%; height: 100%; object-fit: cover;">
                    </a> --}}
                    @foreach ($animal->imagem as $imagem)
                            <a href="{{ Storage::url($imagem->caminho) }}" data-lightbox="roadtrip" data-title="My caption">
                                <img src="{{ Storage::url($imagem->caminho) }}"
                                 alt="Imagem do Animal"
                                 style="width: 100px; height: 75px; object-fit: cover; margin: 5px;">
                            </a>
                    @endforeach

                </div>
                {{-- <div class="gallery">
                    @foreach ($animal->imagem as $imagem)
                        <a href="{{ Storage::url($imagem->caminho) }}"
                           data-lightbox="animal-gallery"
                           data-title="Imagem do Animal">
                            <img src="{{ Storage::url($imagem->caminho) }}"
                                 alt="Imagem do Animal"
                                 style="width: 100px; height: 75px; object-fit: cover; margin: 5px;">
                        </a>
                    @endforeach
                </div> --}}

                {{-- <div class="gallery">
                    <div class="gallery-preview">
                        <img src="{{ Storage::url($animal->imagem->first()->caminho) }}" alt="imagem do animal" class="gallery-main-image">
                    </div>
                    <div class="gallery-thumbnails">
                        @foreach ($animal->imagem as $image)
                        <div class="gallery-thumbnail">
                            <img src="{{ Storage::url($image->caminho) }}" alt="imagem do animal" data-large-image="{{ Storage::url($image->caminho) }}">
                        </div>
                        @endforeach
                    </div>
                </div> --}}



            </div>

            <div class="col col-md-7">
                <div class="col-md-12 form-group">
                    <label for="name">Titulo</label>
                    <input maxlength="200" type="search" class="form-control" name="titulo"
                        value="{{ $animal->titulo }}" readonly>
                </div>
                <div class="row pr-2 pl-2">
                    <div class="col-md-6 form-group">
                        <label for="name">Animal</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->animal }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="name">Criado por</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->user->name }}" readonly>
                    </div>
                </div>

                <div class="col-md-12 form-group">
                    <label for="name">Descrição</label>
                    <textarea rows="2" class="form-control" name="descricao"
                        readonly>{{ $animal->descricao }}</textarea>
                </div>
                <div class="row form-group pr-2 pl-2">
                    <div class="col-md-4 form-group">
                        <label for="name">Latitude</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->lat }}" readonly>
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="name">Longitude</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->lon }}" readonly>
                    </div>


                    <div class="col-md-4 form-group">
                        <label for="name">Estado</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->estado }}" readonly>
                    </div>

                </div>
                <div class="row pr-2 pl-2">



                </div>
                <div class="row form-group pr-2 pl-2">

                    <div class="col-md-6 form-group">
                        <label for="name">Cidade</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->cidade }}" readonly>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="name">Status</label>
                        <input maxlength="200" type="search" class="form-control" name="animal"
                            value="{{ $animal->publicado == '0' ? 'Não publicado' : 'Publicado' }}" readonly>
                    </div>

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

                <button type="submit" class="btn btn-primary float-right text-nowrap"><i class="fa fa-search"></i>
                    Pesquisar</button>
                <a href="{{ route('animalweb.index') }}" class="btn btn-outline-primary text-nowrap mr-4"><i
                        class="fa fa-eraser "></i> Limpar busca</a>

            </div>
        </div> --}}

    {{-- </form> --}}

</div>
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Localização no mapa</h3>
    </div>


    <div id="map" style="width: 100%; height: 500px;" class="elevation-1 pt-5"></div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Coordenadas para Montes Claros, MG
        const montesClarosCoords = [-16.7282, -43.8578];

        // Inicializar o mapa
        const map = L.map('map').setView(montesClarosCoords, 13);

        // Adicionar camada base (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Coordenadas dos pontos
        const ponto = @json($coordenada);

        // Definir um ícone personalizado
        const customIcon = L.icon({
            iconUrl: '{{ asset('logo/logo.jpg') }}', // Substitua pelo caminho para sua imagem
            iconSize: [28, 28], // Tamanho do ícone [largura, altura]
            iconAnchor: [19, 38], // Ponto de ancoragem [x, y] (normalmente no centro inferior)
            popupAnchor: [0, -38] // Posição do popup em relação ao ícone
        });

        // Adicionar marcadores para cada ponto
        // pontos.forEach(ponto => {
            L.marker([ponto.lat, ponto.lng], { icon: customIcon })
                .addTo(map)
                .bindPopup(ponto.titulo); // Adiciona um popup com a descrição
        // });
    });
</script>

@stop
