@extends('layouts.app', ['ignoreDefaultContainers' => true])

@php
    $usesCaptcha = config('academy.site.register.captchaActivated', false);
@endphp

@if ($usesCaptcha)
    @push('scripts')
        {!! ReCaptcha::htmlScriptTagJsApi() !!}
    @endpush
@endif

@section('content')
    <div class="register-container">
        <div class="container">
            <div class="row m-0">
                <h2 class="text-white font-weight-bold w-100 text-center">Crie sua conta agora</h2>
                <h6 class="w-100 text-center text-light">A diversão e seus novos amigos estão te esperando!</h6>
            </div>
            <form action="{{ route('web.register') }}" method="post">
                @csrf
                <div class="default-box full">
                    <i class="user" style="top: 30px"></i>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" placeholder="Seu usuário" name="username" id="username" autocomplete="username" autofocus>
                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i><strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="default-box full">
                    <i class="letter"></i>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Seu e-mail" name="email" id="email" autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i><strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row separator-arrow mt-4"><i class="fas fa-angle-double-down fa-2x"></i></div>
                <div class="default-box full">
                    <i class="password"></i>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Sua senha" name="password" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <i class="fas fa-exclamation-circle mr-2"></i><strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="default-box full">
                    <i class="password"></i>
                    <input type="password" class="form-control" placeholder="Confirme a senha" name="password_confirmation" id="password-confirm">
                </div>
                @if ($usesCaptcha)
                <div class="default-box full d-flex justify-content-center">
                    {!! htmlFormSnippet() !!}
                </div>
                @endif
                <div class="default-box full">
                    <button class="join" type="submit">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
@endsection