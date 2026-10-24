<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class TradedupSectionSubmission extends Model
{
    protected $table = "tradedup_section_submission";
    protected $fillable = ["tradedup_section_id", "product_id", "quantity", "value", 'init_value'];

    public function tradedupSubmission() {
    	return $this->belongsTo('TradeInTradeUp\Submissions');
    }
    public function attached_product() {
    	return $this->hasOne('TradeInTradeUp\Products', 'id', 'product_id');
    }
}
