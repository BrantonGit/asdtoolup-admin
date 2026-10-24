<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class ReceiptSections extends Model
{
    protected $table = "receipt_sections";
    protected $fillable = ['submission_id', 'status', 'comments', 'reason_id'];

    public function receiptsuploaded() {
    	return $this->hasMany('TradeInTradeUp\ReceiptSectionSubmission', 'receipt_section_id', 'id');
    }

    public function status_state() {
        return $this->hasOne('TradeInTradeUp\Statuses', 'id', 'status');
    }

    //THIS IS BEING SWITCHED TO TRADE INS. receipt_section_id no longer exists and is now tradein_section_id
    // public function receipt_products() {
    //     return $this->hasMany('TradeInTradeUp\ReceiptProducts', 'receipt_section_id', 'id');
    // }
}
