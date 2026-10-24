<?php

namespace TradeInTradeUp;

use Illuminate\Database\Eloquent\Model;

class HistoryStages extends Model
{
    protected $table = "history_stages";
    protected $fillable = ['submission_id', 'author_id'];

    public function history_stages_submission() {
    	return $this->hasMany('TradeInTradeUp\HistoryStageSubmission', "history_stages_submission_id", "id");
    }

}
