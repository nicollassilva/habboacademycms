<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'min:3', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
            'password' => ['nullable', 'min:6', 'max:255', 'confirmed']
        ]);

        $user = \Auth::user();

        if(!$user) {
            return redirect()->route('web.academy.index');
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $userHasCustomAvatar = $user->profile_image_path && $user->profile_image_path != config('academy.defaultProfileImagePath');

            if ($userHasCustomAvatar) {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            $image = $request->file('avatar');
            $imageName = time() . \Str::random(10) . "." . $image->extension();

            $user->profile_image_path = $image->storeAs('profiles', $imageName);
        }
        
        $user->name = $request->name;

        $user->password = (
            isset($data['password']) ? Hash::make($data['password']) : $user->password
        );

        $user->save();

        return redirect()
            ->route('web.users.edit')
            ->with('success', 'Perfil alterado!');
    }

    public function forumUpdate(Request $request)
    {
        $data = $request->validate([
            'forumSignature' => ['nullable', 'string', 'max:1000']
        ]);

        $user = \Auth::user();

        $user->update([
            'forum_signature' => nl2br(htmlspecialchars($data['forumSignature']))
        ]);

        return redirect()
            ->route('web.users.edit')
            ->with('success', 'user-signature foi atualizada.');
    }
}
