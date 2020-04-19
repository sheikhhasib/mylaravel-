<?php

namespace App;
use App\Iteam;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['order_id','item_id', 'qty', 'user_id', 'order_date', 'price'];


    public function items()
    {
        return $this->hasOne(Item::class,'id','item_id');
    }
    function relationtouser()
    {
        return $this->hasOne('App\User','id','user_id');
    }

}
