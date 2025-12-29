<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Theme;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;

class ProfilesController extends Controller
{
    public function show($username)
    {
       try {
            $user = $this->getUserByUsername($username);
       
  
        } catch (ModelNotFoundException $exception) {
            abort(404);
        }
        $currentTheme = Theme::find($user->profile->theme_id);
        $data = [
            'user'         => $user,
            'currentTheme' => $currentTheme,
        ];
        return view('profiles.show',compact('user'));
       
    }
    public function getUserByUsername($username)
    {
          return User::wherename($username)->firstOrFail();
    }
    /**
     * Display the user's profile form.
     */
    public function edit($username): View
    {
        try {
            $user = $this->getUserByUsername($username);
        } catch(ModelNotFoundException $exception) {
          return view('pages.status')
                ->with('error', trans('profile.notYourProfile'))
                ->with('error_title', trans('profile.notYourProfileTitle'));
        }
        $themes = Theme::where('status', 1)
                       ->orderBy('name', 'asc')
                       ->get();
        $currentTheme = Theme::find($user->profile->theme_id);
        $data = [
            'user'          => $user,
            'themes'        => $themes,
            'currentTheme'  => $currentTheme,

        ];

        return view('profiles.edit')->with($data);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
