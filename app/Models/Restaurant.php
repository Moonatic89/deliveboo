<?php

namespace App\Models;

use App\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'vat',
        'address',
        'restaurant_image',
        'description',
        'website',
        'phone',
        'user_id',
    ];

    //Relazione 1 to many
    //Un ristorante appartiene ad un solo utente (one)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Relazione many to many
    //Una categoria può avere più ristoranti
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    //Relazione 1 to many
    //Un ristorante può avere più prodotti (many)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}