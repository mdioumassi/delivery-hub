<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class AllGpCompaniesController extends Controller
{
    public function gpCompanies()
    {
        $companies = Company::all();
        return view('frontend/gp-companies.index', compact('companies'));
    }

    public function gpCompany($id)
    {
        $company = Company::find($id);

        return view('frontend/gp-companies.show', compact('company'));
    }
    /**
     * Step 2: Store package
     * route: gp-companies.step2
     * path: /gp-companies/step2/package/{id}
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function store(Request $request, $id)
    {
        $package = [
            'destination_id' => $request->destination
        ];
    
        $request->session()->put('package_data', $package);

        $company = Company::find($id);

        return view('frontend/gp-companies.package', compact('company'));
    }

    /**
     * Step 3: Store person
     * route: gp-companies.step3
     * 
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function storeInfoPerson(Request $request, $id)
    {
        $package_data = $request->session()->get('package_data');
        
        $package_data = [
            'type' => $request->type,
            'weight' => $request->weight,
            'date_envoi' => $request->date_envoi,
        ];

        $request->session()->put('package_data', $package_data);

        $company = Company::find($id);

        return view('frontend/gp-companies.expediteur', compact('company'));
    }
}