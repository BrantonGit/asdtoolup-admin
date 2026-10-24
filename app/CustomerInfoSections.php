<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class CustomerInfoSections extends Model
{
    protected $table = "customerinfo_sections";
    protected $fillable = ['id','submission_id', 'status', 'comments', 'reason_id', 'fname', 'lname', 'email', 'company','channel', 'profession', 'phone', 'address', 'city', 'country', 'postal', 'chequeissue'];

    public function status_state() {
        return $this->hasOne('TradeInTradeUp\Statuses', 'id', 'status');
    }
}
