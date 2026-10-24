<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\TradedupSectionSubmission;

class TradedupSectionSubmissionController extends Controller
{
    public function test() {
        $post = TradedupSectionSubmission::all()->toArray();
        dd($post);
    }
}
