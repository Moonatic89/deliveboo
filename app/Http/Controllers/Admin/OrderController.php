<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Chart;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $order_id = DB::table('order_product')->where('restaurant_id', $id)->pluck('order_id')->unique();
    $array_order_id = [];

    $i = 0;
    foreach ($order_id as $value) {
      $array_order_id[] = $value;
      $i++;
    }
    if (count($array_order_id) > 0) {

      $orders = Order::whereIn('id', $array_order_id)->orderby('created_at', 'DESC')->get();

      return view('admin.restaurants.orders.index', compact('orders'));
    }

    return view('admin.restaurants.orders.index');
  }

  public function chart($id)
  {
    $order_id = DB::table('order_product')->where('restaurant_id', $id)->pluck('order_id')->unique()->sortBy('created_at');
    $array_order_id = [];



    foreach ($order_id as $value) {
      $array_order_id[] = $value;
    }

    if (count($array_order_id) > 0) {
      /* ddd($array_order_id, 'dentro'); */

      $data = Order::whereIn('id', $array_order_id)->select('amount', 'created_at')->orderBy('created_at', 'ASC')->get()->groupBy(function ($data) {
        return Carbon::parse($data->created_at)->format('Y, M');
      });


      $amounts = Order::whereIn('id', $array_order_id)->select(
        DB::raw('ANY_VALUE(created_at) AS created_at'),
        DB::raw('sum(amount) as `sums`'),
        DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
      )
        ->orderBy('created_at')
        ->groupBy('months')
        ->get();


      $months = [];
      $monthOrders = [];
      foreach ($data as $month => $values) {

        $months[] = $month;
        $monthOrders[] = count($values);
      }



      $amountOrders = [];
      foreach ($amounts as $amount) {

        $amountOrders[] = $amount->sums;
      }

      return view('admin.restaurants.orders.chart', compact('id', 'months', 'monthOrders', 'amountOrders'));
    }

    return view('admin.restaurants.orders.noChart');
  }
}
