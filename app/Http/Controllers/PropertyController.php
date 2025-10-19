<?php

namespace App\Http\Controllers;

use App\Models\Property;

class PropertyController extends Controller
{
    // Afficher la liste des propriétés
    public function index()
    {
        $properties = Property::all();
        return view('properties.index', compact('properties'));
    }

}
