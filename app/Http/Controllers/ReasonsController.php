<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\Reasons;

class ReasonsController extends Controller
{
    public function test() {
        $post = Reasons::all()->toArray();
        dd($post);
    }
}
