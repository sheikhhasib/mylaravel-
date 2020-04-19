<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = ['id'];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }
    public function ItemIngredient()
    {
        return $this->hasMany(ItemIngredient::class,'item_id','id');
    }
}
