<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    public $timestamps = false;

    protected $fillable = ['user_id', 'token', 'expire_at'];


}
