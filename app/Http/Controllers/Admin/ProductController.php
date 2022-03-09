<?php

//TODO - I need to make Auth validation for every user interactible function

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($restaurant_id)
    {
        return view('admin.products.create', compact('restaurant_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $restaurants = Restaurant::all();

        // New Product Validation
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'ingredients' => ['nullable'],
            'price' => ['required', 'numeric', 'min:0'],
            'product_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
            'visible' => ['boolean'],
            'restaurant_id' => ['exists:restaurants,id'],
        ]);

        // Product Image(file) storaging
        if ($request->file('product_image')) {
            $image_path = Storage::put(
                'product_image',
                $request->file('product_image')
            );
            $validated['product_image'] = $image_path;
        }

        //This is to prevent hacking restaurant product - LONG LIVE DIEGO
        foreach ($restaurants as $restaurant) {
            //In detail: check if Auth is === to restaurant user AND if restaurant ID is == to the one passed as data on creation
            if (
                Auth::id() === $restaurant->user_id &&
                $validated['restaurant_id'] == $restaurant->id
            ) {
                /*
                Since for now we are not adding another pivot table, there is nothing else to update after Product creation.
                So, if the user that created the product has the same id as the restaurant, create the product and return to
                the Index view, if not aborts the operation
                */
                //ddd($validated);
                $products = Product::all()->where('name', $validated['name'])->where('restaurant_id', $validated['restaurant_id']);

                if (count($products) > 0) {

                    return redirect()->back()->with('message', 'Prodotto già disponibile nel tuo menù');
                }
                $product = Product::create($validated);
                return redirect()
                    ->route(
                        'admin.restaurants.show',
                        compact('restaurant', 'product')
                    )
                    ->with('message', 'Prodotto creato con successo');
            }
        }
        abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        foreach (Auth::user()->restaurants as $restaurant) {
            if ($product->restaurant_id == $restaurant->id) {
                $validated = $request->validate([
                    'name' => ['required', 'min:3', 'max:200'],
                    'ingredients' => ['nullable'],
                    'price' => ['required', 'numeric', 'min:0'],
                    'product_image' => ['nullable', 'mimes:jpg,jpeg,bmp,png'],
                    'visible' => ['boolean'],
                    'restaurant_id' => ['exists:restaurants,id'],
                ]);

                if ($request->file('product_image')) {
                    Storage::delete($product->product_image);

                    $image_path = Storage::put(
                        'product_image',
                        $request->file('product_image')
                    );
                    $validated['product_image'] = $image_path;
                }

                $products = Product::all()->where('name', $validated['name'])->where('restaurant_id', $product['restaurant_id']);
                $products = $products->except($product->id);
                if (count($products) > 0) {

                    return redirect()->back()->with('message', 'Prodotto già disponibile nel tuo menù');
                }

                $product->update($validated);

                return redirect()
                    ->route(
                        'admin.restaurants.show',
                        compact('restaurant', 'product')
                    )
                    ->with('message', 'Prodotto modificato con successo');
            }
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //Delete the product
        $product->delete();
        return redirect()
            ->back()
            ->with('message', 'The dish has been correctly removed!');
    }
}
