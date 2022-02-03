@extends('layouts.app')

@section('title', "Página Principal")

@section('content')
<div class="container mt-2">
    <div class="slider">
        <div class="swiper-container customTransition indexSlider">
            <div class="swiper-wrapper">
                @foreach ($slides as $slide)
                <div class="swiper-slide">
                    <div class="swiper-image" style="background-image: url('{{ \Str::contains($slide->image_path, 'slides') ? asset("{$slide->image_path}") : $slide->image_path }}')"></div>
                    <a href="{{ $slide->slug }}" @if ($slide->new_tab) target="_blank" @endif>
                        <div class="swiper-data">
                            <div class="title text-truncate">{{ $slide->title }}</div>
                            <div class="description text-truncate">{{ $slide->description }}</div>
                        </div>
                    </a>
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