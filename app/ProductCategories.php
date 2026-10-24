<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class ProductCategories extends Model
{
    //
    protected $table = "product_categories";
    protected $fillable = ["name"];
}
