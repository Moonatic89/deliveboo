<?php

namespace App\Models;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    //Relazione many to many
    //Un ristorante può avere più categorie
    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }
}