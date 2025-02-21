<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class AllGpCompaniesController extends Controller
{
    public function gpCompanies()
    {
        $companies = Company::all();
        return view('gp-companies.index', compact('companies'));
    }
}