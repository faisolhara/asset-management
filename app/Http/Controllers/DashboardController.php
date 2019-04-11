<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Transaction\ProjectController;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    const URL       = '/';

    public function index(Request $request){
        // dd(\Session::get('user'));
        return view('dashboard');    
    }
   
}
