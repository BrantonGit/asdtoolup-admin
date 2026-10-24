<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Statuses extends Model
{
    protected $table = "statuses";
    protected $fillable = ["status"];
}
