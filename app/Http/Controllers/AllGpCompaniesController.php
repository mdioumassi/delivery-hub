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
}