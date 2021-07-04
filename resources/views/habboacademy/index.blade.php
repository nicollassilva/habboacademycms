@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="slider">
        <div class="swiper-container customTransition indexSlider">
            <div class="swiper-wrapper">
                @for ($i = 0; $i < 10; $i++)
                <div class="swiper-slide">
                    <div class="swiper-image"
                         style="background-color: red">
                    </div>
                    <div class="swiper-data">
                        <div class="title text-truncate">Slide {{ $i }}</div>
                        <div class="description text-truncate">Descrição do slide {{ $i }}</div>
                    </div>
                </div>
                @endfor
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @include('habboacademy.layouts.lastdata')
    @include('habboacademy.layouts.news')
</div>
@include('habboacademy.layouts.forum')
@endsection