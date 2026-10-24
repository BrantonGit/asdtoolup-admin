<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class PaymentStatuses extends Model
{
    protected $table = "payment_statuses";
    protected $fillable = ['status'];
}
