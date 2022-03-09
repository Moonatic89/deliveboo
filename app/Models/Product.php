<?php

namespace App\Models;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'ingredients',
        'price',
        'visible',
        'product_image',
        'restaurant_id',
    ];

    //Relazione 1 to many
    //Un prodotto appartiene ad un solo ristorante (one)
    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    //Relazione many to many
    //Un ordine può avere più prodotti
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('order_product')->withTimestamps();
    }
}
