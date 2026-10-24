<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class TradedinSectionSubmission extends Model
{
    protected $table = "tradedin_section_submission";
    protected $fillable = ["tradedin_section_id", "photo"];

    public function tradedinSubmission() {
    	return $this->belongsTo('TradeInTradeUp\Submissions');
    }
}
