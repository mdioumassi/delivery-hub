<?php

namespace App\Http\Controllers;

use App\Enums\CivilityEnum;
use App\Enums\PersonTypeEnum;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Rinvex\Country\CountryLoader;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $persons = Person::with('user')->paginate(10);
        return view('persons.index', compact('persons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('persons.create', [
            'countries' => CountryLoader::countries(),
            'civilities' => CivilityEnum::cases(),
            'types' => PersonTypeEnum::cases(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'civility' => 'required',
            'type' => 'required',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'street' => 'nullable|string',
            'city' => 'nullable|string',
            'zip_code' => 'nullable|string',
            'country' => 'required|string',
        ]);

        // Utilisation d'une transaction pour s'assurer que les deux enregistrements sont créés
        DB::transaction(function () use ($request) {
            // Créer l'utilisateur
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Créer la personne liée à l'utilisateur
            Person::create([
                'civility' => $request->civility,
                'type' => $request->type,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'street' => $request->street,
                'city' => $request->city,
                'zip_code' => $request->zip_code,
                'country' => $request->country,
                'user_id' => $user->id,
            ]);
        });

        return redirect()->route('persons.index')->with('success', 'Personne créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return view('persons.show', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        
        return view('persons.edit', [
            'person' => $person,
            'countries' => CountryLoader::countries(),
            'civilities' => CivilityEnum::cases(),
            'types' => PersonTypeEnum::cases(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Person $person)
    {
        $validatedData = $request->validate([
            'civility' => 'required',
            'type' => 'required',
            'fullname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . $person->user_id,
            'street' => 'required|string',
            'city' => 'required|string',
            'zip_code' => 'required|string',
            'country' => 'required|string',
            'password' => 'nullable|min:8|confirmed',
        ]);
    
        // Mettre à jour les informations de la personne
        $person->update([
            'civility' => $validatedData['civility'],
            'type' => $validatedData['type'],
            'fullname' => $validatedData['fullname'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'street' => $validatedData['street'],
            'city' => $validatedData['city'],
            'zip_code' => $validatedData['zip_code'],
            'country' => $validatedData['country'],
        ]);
    
        // Mettre à jour l'utilisateur associé
        $userData = [
            'email' => $validatedData['email'],
        ];
    
        // Mettre à jour le mot de passe uniquement s'il est fourni
        if (!empty($validatedData['password'])) {
            $userData['password'] = Hash::make($validatedData['password']);
        }
    
        $person->user->update($userData);
    
        return redirect()->route('persons.index')->with('success', 'Personne mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        //
    }
}
