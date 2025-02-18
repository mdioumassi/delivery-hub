<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rinvex\Country\CountryLoader;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $countries = CountryLoader::countries(); 
        return view('users.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'civility' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'required',
            'type' => 'nullable',
            'street' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable',
            'country' => 'nullable',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }
    /**
     * Show the form for editing the specified resource.
     * @param  \App\Models\User  $user
     * route: GET /users/id
     * name: users.show
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Edit the specified resource.
     * @param  \App\Models\User  $user
     * route: GET /users/id/edit
     * name: users.edit
     * @return \Illuminate\Http\Response
     *
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'firstname' => 'required',
            'lastname' => 'required',
            'phone' => 'required',
            'role' => 'required|in:admin,user,manager',
            'type' => 'required|in:client,gestionnaire'
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
