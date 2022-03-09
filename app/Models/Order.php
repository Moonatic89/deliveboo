<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'email',
        'address',
        'notes',
        'amount',
    ];
    //Relazione many to many
    //Un prodotto può essere in più ordini
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('order_product')->withTimestamps();
    }
}
