<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class PaymentSection extends Model
{
    protected $table = "payment_section";
    protected $fillable = ['id','submission_id','payment_amount_cad', 'remainingvalue'];

    public function submission(){
        return $this->hasOne('TradeInTradeUp\Submissions', 'id', 'submission_id');
    }
}
