<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemIngredient extends Model
{
    //
    protected $fillable = ['item_id','ingredient_id','unit_id','qty','status','created_by'];

    public function ingredient()
    {
        return $this->hasOne(Ingredient::class,'id','ingredient_id');
    }
}
