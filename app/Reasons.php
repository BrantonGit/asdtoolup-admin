<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Reasons extends Model
{
    protected $table = "reasons";
    protected $fillable = ["reason"];
}
