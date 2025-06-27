@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2>Bienvenido a La Colchonera</h2>
        <p>Elige lo que necesites, ¡Mira nuestros productos!   </p>

    </div>

    {{-- Carrusel Bootstrap --}}
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/slide1.jpg') }}" class="d-block w-100" alt="Colchón 1">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide2.jpg') }}" class="d-block w-100" alt="Colchón 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide3.jpg') }}" class="d-block w-100" alt="Colchón 3">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide4.jpg') }}" class="d-block w-100" alt="Colchón 4">
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/slide5.jpg') }}" class="d-block w-100" alt="Colchón 5">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</div>
@endsection
