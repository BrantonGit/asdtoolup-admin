<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\TradedinSectionSubmission;

class TradedinSectionSubmissionController extends Controller
{
    public function test() {
        $post = TradedinSectionSubmission::all()->toArray();
        dd($post);
    }
}
