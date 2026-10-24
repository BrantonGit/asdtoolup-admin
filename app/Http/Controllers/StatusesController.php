<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\Statuses;

class StatusesController extends Controller
{
    public function test() {
        $post = Statuses::all()->toArray();
        dd($post);
    }
}
