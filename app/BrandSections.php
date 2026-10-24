<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class BrandSections extends Model
{
    //
    protected $table = "brand_tradein_section";
    protected $fillable = ["tradedin_section_id"];
    
    public function brands_submissions() {
        return $this->hasMany('TradeInTradeUp\BrandSectionSubmission', 'brand_tradedin_section_id', 'id' );
    }
}
