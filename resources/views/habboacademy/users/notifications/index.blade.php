@extends('layouts.app')

@section('title', "Minhas notificações")

@section('content')
<div class="container">
    @include('habboacademy.utils.alerts')
    <div class="box-content bg-white box-postar">
        <div class="titulo">
            <span>Minhas notificações</span>
        </div>
        <div class="content p-0 table-responsive" style="min-height: auto; max-height: auto;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Origem</th>
                        <th scope="col">Notificação</th>
                        <th scope="col">Data</th>
                        <th scope="col">Deletar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td width="10" class="text-center">
                                <span @class([
                                    "badge p-2", $notification->getNotificationColor()
                                ])>{{ $notification->getNotificationType() }}</span>
                            </td>
                            <td>
                                <a class="text-dark" href="{{ $notification->slug }}">
                                    {{ $notification->title }}
                                </a>
                            </td>
                            <td width="150">{{ $notification->created_at->format('d-m-Y h:i') }}</td>
                            <td width="10">
                                <form method="post" action="{{ route('web.users.notifications.delete', $notification->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="ml-2" type="submit" style="width: 30px; height: 30px; background-color: red">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if(!$notifications->total())
                        <tr>
                            <th colspan="5">
                                <span class="w-100 text-secondary text-center float-left">
                                    <i class="fas fa-battery-empty mr-2"></i>Nenhuma notificação encontrada.
                                </span>
                            </th>
                        </tr>
                    @else
                    <tr>
                        <th colspan="5">
                            <div class="d-flex float-right">
                                <button class="btn btn-sm btn-dark" type="submit" onclick="deleteAllNotifications()">Apagar tudo</button>
                            </div>
                        </th>
                    </tr>
                    @endif
                </tbody>
                <form id="formDeleteAll" method="post" action="{{ route('web.users.notifications.deleteAll') }}">
                    @csrf @method('DELETE')
                </form>
                <tfoot>
                    <tr>
                        <th colspan="5">
                            {!! $notifications->links('habboacademy.utils.custom_paginator') !!}
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
    function deleteAllNotifications() {
        if(!window.confirm('Deseja apagar todas as notificações?')) {
            return false
        }

        document.getElementById('formDeleteAll').submit()
    }
</script>
@endsection