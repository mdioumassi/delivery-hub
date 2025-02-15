<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_fixe' => 'required',
            'phone_mobile' => 'required',
            'phone_whatsapp' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'user_id' => 'required|exists:users,id',
            'logo_url' => 'nullable|image',
        ]);

        if ($request->hasFile('logo_url')) {
            $validated['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        Company::create($validated);

        return redirect()->route('companies.index')->with('success', 'Entreprise créée avec succès.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_fixe' => 'required',
            'phone_mobile' => 'required',
            'phone_whatsapp' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'country' => 'required',
            'user_id' => 'required|exists:users,id',
            'logo_url' => 'nullable|image',
        ]);

        if ($request->hasFile('logo_url')) {
            $validated['logo_url'] = $request->file('logo_url')->store('logos', 'public');
        }

        $company->update($validated);

        return redirect()->route('companies.index')->with('success', 'Entreprise mise à jour avec succès.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Entreprise supprimée avec succès.');
    }
}