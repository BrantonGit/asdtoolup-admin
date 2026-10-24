<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\HistoryStages;

class HistoryStagesController extends Controller
{
    public function test() {
        $post = HistoryStages::all()->toArray();
        dd($post);
    }
}
