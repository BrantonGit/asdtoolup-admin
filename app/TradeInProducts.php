<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class TradeInProducts extends Model
{
    //
    protected $table = "tradein_products";
    protected $fillable = ['tradedin_section_id', 'product_number', 'product_qty', 'brand'];
}
