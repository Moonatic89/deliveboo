<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Mail\SendMail;
use App\Mail\SendMailToAdmin;
use Illuminate\Http\Request;
use Braintree;
use Braintree\Gateway;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function checkout(Gateway $gateway)
    {
        $token = $gateway->ClientToken()->generate();

        // ddd(env('BRAINTREE_ENV'));


        return view('guest.checkout.checkout', compact('token'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gateway $gateway)
    {
        $cart_products = json_decode($request->input('cart'));
        $cart_total = (float) number_format($request->input('amount'), 2);

        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:200'],
            'last_name' => ['required', 'min:3', 'max:200'],
            'phone' => ['required', 'min:9', 'max:30'],
            'email' => ['required', 'max:200'],
            'address' => ['required', 'min:3', 'max:200'],
            'notes' => ['nullable'],
            'amount' => ['required', 'numeric'],
            'status' => ['nullable'],
        ]);

        // creo i records nella tabella pivot
        /* for ($i = 0; $i < sizeof($cart_products); $i++) {
            $order->products()->attach([
                $cart_products[$i]->id => [
                    'quantity' => $cart_products[$i]->qty,
                ],
            ]);
        } */

        //controllare se il pagamento è andato a buon fine e cambiare lo stato dell'ordine da false a true
        //$order->save();

        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true,
            ],
        ]);
        //ddd($amount, $nonce, $result);

        if ($result->success) {
            $order = Order::create($validated);

            /* $products = collect($request->input('products', []))->map(function (
                $product
            ) {
                return ['quantity' => $product];
            });

            $order->products()->sync($products); */

            // creo i records nella tabella pivot
            for ($i = 0; $i < sizeof($cart_products); $i++) {
                $order->products()->attach([
                    $cart_products[$i]->id => [
                        'quantity' => $cart_products[$i]->qty,
                        'restaurant_id' => $cart_products[$i]->restaurant_id,
                    ],
                ]);
            }

            $order['status'] = true;

            //Email al cliente
            Mail::to($request->email)->send(new SendMail($order));

            //Email al ristoratore
            $id_restaurant = $cart_products[0]->restaurant_id;
            $restaurant = Restaurant::where('id', $id_restaurant)->get();
            $user = User::where('id', $restaurant[0]->user_id)->get();
            Mail::to($user[0]['email'])->send(new SendMailToAdmin($order));

            return view('guest.checkout.success');
        } else {
            $errorString = '';

            foreach ($result->errors->deepAll() as $error) {
                $errorString .=
                    'Error: ' . $error->code . ': ' . $error->message . "\n";
            }

            return back()->withErrors(
                'An error occurred with the message: ' . $result->message
            );
        }
    }
}