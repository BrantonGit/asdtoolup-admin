<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class TradedupSections extends Model
{
    protected $table = "tradedup_sections";
    protected $fillable = ["submission_id", "status", "comments", "reason_id", ];

    public function tradedupuploaded() {
    	return $this->hasMany('TradeInTradeUp\TradedupSectionSubmission', 'tradedup_section_id', 'id');
    }

    public function status_state() {
        return $this->hasOne('TradeInTradeUp\Statuses', 'id', 'status');
    }
}
