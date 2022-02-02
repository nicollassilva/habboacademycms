<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User\UserNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = UserNotification::getDefault();

        return view('habboacademy.users.notifications.index', [
            'notifications' => $notifications
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();

        if(! $notification = $user->notifications()->find($id)) {
            return redirect()
                ->route('web.users.notifications.index')
                ->with('warning', 'Notificação não encontrada.');
        }

        $notification->delete();

        return redirect()
            ->route('web.users.notifications.index')
            ->with('success', 'Notificação removida com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAll()
    {
        $user = \Auth::user();

        $user->notifications()->each(function ($notification) {
            $notification->delete();
        });

        return redirect()
            ->route('web.users.notifications.index')
            ->with('success', 'Notificações removidas com sucesso!');
    }
}
