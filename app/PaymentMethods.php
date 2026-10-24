<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $table = "payment_method";
    protected $fillable = ['method'];
}

