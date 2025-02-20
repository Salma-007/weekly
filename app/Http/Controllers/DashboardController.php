<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Afficher la page du tableau de bord.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $annoncesCount = Annonce::count();
        $categoriesCount = Category::count();

        return view('dashboard', compact('annoncesCount', 'categoriesCount'));
    }
}

