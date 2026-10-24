<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class BrandSectionSubmission extends Model
{
    //
    protected $table = "brand_tradein_submission";
    protected $fillable = ["brand_tradedin_section_id", "brand_id"];

    public function brand_title() {
        return $this->hasOne('TradeInTradeUp\Brands', 'id', 'brand_id');
    }
}
