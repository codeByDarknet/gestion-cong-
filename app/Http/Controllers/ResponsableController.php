<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    //
    public function dashboard()
    {
        return view('responsable.dashboard');
    }
}
