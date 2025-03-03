<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Service;
use App\Models\Package;
use App\Models\Container;
use App\Models\Destination;

class DashboardController extends Controller
{
    public function index()
    {
        // Récupération du nombre de chaque élément
        $data = [
            'countUtilisateurs' => User::count(),
            'countEntreprises' => Company::count(),
            'countServices' => Service::count(),
            'countColis' => Package::count(),
            'countConteneurs' => Container::count(),
            'countDestinations' => Destination::count()
        ];

        return view('dashboard', $data);
    }
}