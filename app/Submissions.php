<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class Submissions extends Model
{
    //
    protected $table = 'customer_submissions';
    protected $fillable = ['customer_id', 'payment_status', 'customerinfo_section_id', 'tradedin_section_id', 'tradedup_section_id', 'receipts_section_id', 'history_stages_id', 'status', 'active', 'totalAmount', 'cheque_number'];

    public function receipts() {
    	return $this->hasOne('TradeInTradeUp\ReceiptSections', 'id', 'receipts_section_id');
    }

    public function tradeins() {
    	return $this->hasOne('TradeInTradeUp\TradedinSections', 'id', 'tradedin_section_id');
    }

    public function tradeups() {
    	return $this->hasOne('TradeInTradeUp\TradedupSections', 'id', 'tradedup_section_id');
    }
    
    public function customerInfo() {
    	return $this->hasOne('TradeInTradeUp\CustomerInfoSections', 'id', 'customerinfo_section_id');
    }

    public function author() {
    	return $this->hasOne('TradeInTradeUp\User', 'id', 'customer_id');
    }
    
    public function submission_status() {
        return $this->hasOne('TradeInTradeUp\Statuses', 'id', 'status');
    }

    public function payment_state() {
        return $this->hasOne('TradeInTradeUp\PaymentStatuses', 'id', 'payment_status');
    }

    public function payment_section() {
        return $this->hasOne('TradeInTradeUp\PaymentSection', 'submission_id', 'id');
    }

    // public function event()
    // {
    //     return $this->belongTo('TradeInTradeUp\CustomerInfoSections', 'country', ''can'');
    // }

    public function history_stages() {
    	return $this->hasOne('TradeInTradeUp\HistoryStages', "id", "history_stages_id");
    }

    public function receipt_files() {
        return $this->hasMany('TradeInTradeUp\FileUpload', 'projectid', 'id')->where('intake', '=', 'receipt');
    }
    public function tradein_files() {
        return $this->hasMany('TradeInTradeUp\FileUpload', 'projectid', 'id')->where('intake', '=', 'tradein');
    }


    // public function history_stages_submission() {
    // 	return $this->hasOne('TradeInTradeUp\HistoryStageSubmission', "id", "history_stages_id");
    // }

}
