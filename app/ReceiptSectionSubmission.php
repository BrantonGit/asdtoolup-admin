<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class ReceiptSectionSubmission extends Model
{
    protected $table = "receipt_section_submission";
    protected $fillable = ['receipt_section_id', 'photo', 'kind'];

    public function submission() {
    	return $this->belongsTo('TradeInTradeUp\Submissions');
    }
}
