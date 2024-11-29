@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')

<div id="map" style="width: 100%; height: 500px;" class="elevation-1 pt-5"></div>

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
        const pontos = [
            { lat: -16.7282, lng: -43.8578, descricao: 'Ponto 1: Centro de Montes Claros' },
            { lat: -16.7350, lng: -43.8650, descricao: 'Ponto 2: Parque Municipal' },
            { lat: -16.7225, lng: -43.8500, descricao: 'Ponto 3: Outro local' },
        ];

        // Adicionar marcadores para cada ponto
        pontos.forEach(ponto => {
            L.marker([ponto.lat, ponto.lng])
                .addTo(map)
                .bindPopup(ponto.descricao); // Adiciona um popup com a descrição
        });
    });
</script>

@stop

@section('script')


@stop
