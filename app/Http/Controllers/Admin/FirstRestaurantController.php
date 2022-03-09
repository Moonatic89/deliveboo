<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FirstRestaurantController extends Controller
{
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $categories = Category::all();

    return view('admin.restaurants.withoutr', compact('categories'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    // New Restaurant Validation
    $validated = $request->validate([
      'name' => ['required', 'unique:restaurants', 'max:200'],
      'vat' => ['required', 'unique:restaurants', 'max:200'],
      'address' => ['required', 'unique:restaurants', 'max:200'],
      'restaurant_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
      'description' => ['nullable'],
      'website' => ['nullable', 'unique:restaurants', 'max:200'],
      'phone' => ['nullable', 'unique:restaurants', 'max:30'],
    ]);

    // Create a Slug name for the new Restaurant
    $validated['slug'] = Str::slug($request->name);

    // Restaurant Image(file) storaging
    if ($request->file('restaurant_image')) {
      $image_path = Storage::put(
        'restaurant_image',
        $request->file('restaurant_image')
      );
      $validated['restaurant_image'] = $image_path;
    }

    //New restaurant User authentication
    $validated['user_id'] = Auth::id();

    //Restaurant Creation
    $restaurant = Restaurant::create($validated);


    //Category added to Restaurant
    if ($request->has('categories')) {
      $request->validate([
        'categories' => ['required', 'exists:categories,id'],
      ]);
      $restaurant->categories()->attach($request->categories);
    }

    // Set Has Restaurant to TRUE!  
    $user = User::find($restaurant['user_id']);
    $user->has_restaurant = true;
    $user->save();

    return redirect()->route('admin.restaurants.index');
  }
}
