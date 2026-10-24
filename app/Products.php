<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    protected $table = "products";
    //image_url_lrg used to be celum_image_id
    //switched order of image_url and image_url_large
    //removed "mmm_id" inbetween list_price and rebate_value
    protected $fillable = ["sku", "active", "category_id", "description", "description_fr", "list_price", "rebate_value", "image_url", "image_url_large"];

    public function attached_category() {
    	return $this->hasOne('TradeInTradeUp\ProductCategories', 'id', 'category_id');
    }
}
