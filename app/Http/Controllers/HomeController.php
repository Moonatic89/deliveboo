<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $categories = Category::all();
    $restaurants = Restaurant::all();
    return view('guest.welcome', compact('categories', 'restaurants'));
  }
}
