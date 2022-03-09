<?php

namespace App\Http\Controllers\API;

use App\Models\Category;
use App\Models\Restaurant;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RestaurantResource::collection(
            Restaurant::with('categories')
                ->orderBy('id', 'desc')
                ->paginate(20)
        );
    }

    public function categories()
    {
        return CategoryResource::collection(Category::all());
    }

    public function filter(Request $request)
    {
        $_request = $request['category'];

        $restaurants = Restaurant::whereHas('categories', function (
            $query
        ) use ($_request) {
            $query->whereIn('category_id', $_request);
        })->paginate(20);

        return response()->json($restaurants);
    }
}
