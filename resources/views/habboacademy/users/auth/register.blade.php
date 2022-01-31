@extends('layouts.app', ['ignoreHeader' => true])

@section('title', "Registre-se Agora!")

@section('content')
    @guest
        <div id="register-app">
            <register-page />
        </div>
    @endguest
@endsection