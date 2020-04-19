<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Messbill extends Model
{
    protected $fillable = [
        'user_id',
        'months',
        'years',
        'daily_messing',
        'tea_break',
        'chit_bill',
        'party_bill',
        'sports_subscription',
        'mess_maint',
        'gass_bill',
        'indi_saving',
        'guest_room',
        'arrears',
        'on_payment',
        'others',
    ];

    public function usertomessbill()
    {
        return $this->hasone(User::class,'id','user_id');
    }
}
