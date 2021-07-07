<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function topics()
    {
        $user = \Auth::user();

        return view('habboacademy.users.topics.index', [
            'topics' => $user->topics()->withCount('comments')->latest()->paginate()
        ]);
    }
    
    public function edit()
    {
        return view('habboacademy.users.account.edit', [
            'user' => \Auth::user()
        ]);
    }

    public function update()
    {

    }
}
