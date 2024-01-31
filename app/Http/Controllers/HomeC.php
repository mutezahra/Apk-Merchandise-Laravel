<?php

namespace App\Http\Controllers;

use App\Models\ProductsM;
use App\Models\TransactionsM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;



class HomeC extends Controller
{
    public function index() {
        // Get the authenticated user
        $user = Auth::user();
        $subtitle = "Dashboard";
        // Count all users
        $userCount = User::count(); 
        $productsCount = ProductsM::count();  
        $totalharga= TransactionsM::sum('total_harga');

        // Pass both $user and $userCount to the view
        return view('dashboard', compact('user', 'userCount','subtitle','productsCount', 'totalharga'));
    }
}
