<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class HistoryStageSubmission extends Model
{
    protected $table = "history_stage_submission";
    protected $fillable = ['author_id', 'customerinfo_section_id', 'tradedup_section_id', 'tradedin_section_id', 'receipt_section_id', 'history_stages_submission_id','message', 'messagefr'];

    public function submission() {
    	return $this->belongsTo('TradeInTradeUp\HistoryStages');
    }

    public function customerinfo_section() {
        return $this->hasOne('TradeInTradeUp\CustomerInfoSections', 'id', 'customerinfo_section_id');
    }

    public function receipt_section() {
        return $this->hasOne('TradeInTradeUp\ReceiptSections', 'id', 'receipt_section_id');
    }

    public function tradedin_section() {
        return $this->hasOne('TradeInTradeUp\TradedinSections', 'id', 'tradedin_section_id');
    }

    public function tradedup_section() {
        return $this->hasOne('TradeInTradeUp\TradedupSections', 'id', 'tradedup_section_id');
    }
    public function author() {
    	return $this->hasOne('TradeInTradeUp\User', "id", "author_id");
    }
}
