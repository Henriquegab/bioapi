<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $animais = Animal::all();

        $coordenadas = [];

        foreach($animais as $animal){
            array_push($coordenadas, ['lat' => $animal->lat, 'lng' => $animal->lon, 'titulo' => $animal->titulo]);
        }



        // dd($coordenadas);

        return view('home', ['coordenadas' => $coordenadas]);
    }
}
