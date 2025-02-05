<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemandesController extends Controller
{
    //

    public function index()
    {
        return view('demandes.index');
    }

    public function touteslesdemandes()
    {
        return view('');
    }

}
