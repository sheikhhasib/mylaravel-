<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    //



    public function items()
    {
        return $this->belongsToMany(Items::class);
    }
}
