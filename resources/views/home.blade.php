@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Mapa de cadastros de animais</h3>
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
        const pontos = @json($coordenadas);

        // Definir um ícone personalizado
        const customIcon = L.icon({
            iconUrl: '{{ asset('logo/logo.jpg') }}', // Substitua pelo caminho para sua imagem
            iconSize: [28, 28], // Tamanho do ícone [largura, altura]
            iconAnchor: [19, 38], // Ponto de ancoragem [x, y] (normalmente no centro inferior)
            popupAnchor: [0, -38] // Posição do popup em relação ao ícone
        });

        // Adicionar marcadores para cada ponto
        pontos.forEach(ponto => {
            L.marker([ponto.lat, ponto.lng], { icon: customIcon })
                .addTo(map)
                .bindPopup(ponto.titulo); // Adiciona um popup com a descrição
        });
    });
</script>

@stop

@section('script')


@stop
