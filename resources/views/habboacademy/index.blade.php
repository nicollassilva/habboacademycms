@extends('layouts.app')

@section('title', "Página Principal")

@section('content')
<div class="container mt-4">
    <div class="slider">
        <div class="swiper-container customTransition indexSlider">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                <div class="swiper-slide">
                    <div class="swiper-image"
                         style="background-image: url('{{ asset("storage/{$slide->image_path}") }}')">
                         @if (!empty($slide->slug) || $slide->slug != '#')
                            <div class="d-block w-100 h-100 d-flex justify-content-center align-items-center">
                                <a type="button" href="{{ $slide->slug }}" @if ($slide->new_tab) target="_blank" @endif class="btn btn-dark btn-lg shadow-lg">Acessar</a>
                            </div>
                         @endif
                    </div>
                    <div class="swiper-data">
                        <div class="title text-truncate">{{ $slide->title }}</div>
                        <div class="description text-truncate">{{ $slide->description }}</div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @include('habboacademy.layouts.lastdata')
    @include('habboacademy.layouts.articles')
</div>
@include('habboacademy.layouts.forum')
@endsection