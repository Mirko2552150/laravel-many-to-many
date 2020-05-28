<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use App\InfoUser;
use App\Page;
use App\Tag;
use App\Photo;

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
        $users = User::all();
        $categories = Category::all();
        $users = User::find(1); // prendo solo unu utente
        // dd($users->info); // fa una seconda chiamata all DB collegato INFO relariva al RECOR find(1)
        // dd($users->categories[0]); // categories e' un hasMany restituisce un array
        return view('home');
    }
}
