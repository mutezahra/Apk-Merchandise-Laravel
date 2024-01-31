<?php

namespace App\Http\Controllers;
use App\Models\LogM;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LogC extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        
        $user = Auth::user();
        $subtitle = "Daftar Aktivitas";

        // Define the base query
        $logM = LogM::with('user');

        // Filter activities based on user role
        if ($user->role == 'owner') {
            $logM = $logM->whereHas('user', function ($query) {
                $query->whereIn('role', ['kasir', 'admin']);
            });
        } 

        // Order logs by ID in descending order (from newest to oldest)
        $logM = $logM->orderBy('id', 'desc')->get();

        return view('log_index', compact('subtitle', 'logM'));
    }

}