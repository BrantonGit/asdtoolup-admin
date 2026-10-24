<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\HistoryStagesSubmission;

class HistoryStageSubmissionController extends Controller
{
    public function test() {
        $post = HistoryStagesSubmission::all()->toArray();
        dd($post);
    }
}
