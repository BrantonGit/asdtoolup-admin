<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class TradedinSections extends Model
{
    protected $table = "tradedin_sections";
    protected $fillable = ["submission_id", "status", "comments", "reason_id", 'vendor'];

    public function tradeinuploaded() {
    	return $this->hasMany('TradeInTradeUp\TradedinSectionSubmission', 'tradedin_section_id', 'id');
    }
    public function brands_section() {
        return $this->hasOne('TradeInTradeUp\BrandSections', 'tradedin_section_id', 'id');
    }
    public function status_state() {
        return $this->hasOne('TradeInTradeUp\Statuses', 'id', 'status');
    }
    public function tradein_products() {
        return $this->hasMany('TradeInTradeUp\TradeInProducts', 'tradedin_section_id', 'id');
    }
}
