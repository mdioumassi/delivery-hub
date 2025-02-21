<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Rinvex\Country\CountryLoader;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $companies = Company::with('services')->paginate(10);
        $companies = Company::paginate(10);
        //dd($companies);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        $countries = CountryLoader::countries(); 

        $gestionnaires = User::where('type', 'gestionnaire')->get();
        return view('companies.create', compact('countries','gestionnaires'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_fixe' => 'nullable',
            'phone_mobile' => 'nullable',
            'phone_whatsapp' => 'nullable',
            'email' => 'required|email',
            'street' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable',
            'country' => 'nullable',
            'siret' => 'nullable|numeric',
            'gestionnaire_id' => 'required|exists:users,id'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo_url'] = $path;
        }

        Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Entreprise créée avec succès.');
    }

    public function edit(Company $company)
    {
        $countries = CountryLoader::countries(); 
        $gestionnaires = User::where('type', 'gestionnaire')->get();
        return view('companies.edit', compact('company','countries','gestionnaires'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_fixe' => 'nullable',
            'phone_mobile' => 'nullable',
            'phone_whatsapp' => 'nullable',
            'email' => 'required|email',
            'street' => 'nullable',
            'city' => 'nullable',
            'zip_code' => 'nullable',
            'country' => 'nullable',
            'siret' => 'nullable|numeric',
            'gestionnaire_id' => 'required|exists:users,id'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $validated['logo_url'] = $path;
        }

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}