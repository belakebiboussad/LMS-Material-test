<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Profile;
use App\Models\Commune;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Farm;

class UserCotroller extends Controller
{
    use AuthorizesRequests; // Use the trait here
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }
    public function create()
    {
        $roles = Role::all();
        $cities = Commune::all();
        return view('users.create', compact('roles', 'cities'));
    }
    public function edit(User $user)
    {
        $this->authorize('users.update');
        $roles = Role::all();
        $cities = Commune::all();
        return view('users.edit', compact('roles', 'cities'))->with('user', $user);
    }
    public function show(User $user) {}
    public function store(Request $request)
    {
        $request->validate([
            'prof_id' => 'required|string|size:16|unique:users,prof_id',
            'NIN' => 'required|string|size:20|unique:users,NIN',
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'commune_id' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string|max:255',
            'password' => 'required|min:6|confirmed',
        
        ]);
        if ($request->input('role') === 'admin') {

            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();
            if ($adminUsers->isNotEmpty()) {
                return back()->withInput()->withErrors(['errors' => __('user.admin')]);
            }
        }
        $user = User::create($request->all());
        $role = $request->input('role');
        $user->assignRole($role);
        $profile = new Profile();
        $user->profile()->save($profile);
        return redirect()->route('users.index')->with('success', __('user.updated'));
    }
    public function update(UpdateUserRequest  $request, User $user)
    {
        if ($request->input('role') === 'admin') {
            $adminUsers = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');
            })->get();

            if (! $adminUsers->contains($user) || ($adminUsers->count() > 1))
                return back()->withErrors(['errors' => __('user.admin')]);
        }
        $user->update($request->all());
        $user->assignRole($request->input('role'));
        // 'utilisateur mis à jour avec succès'
        return redirect()->route('users.index')->with('success',  __('user.updated'));
    }
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success',  __('user.deleted'));
    }
}
