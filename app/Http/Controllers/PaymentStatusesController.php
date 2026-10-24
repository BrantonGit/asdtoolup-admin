<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\PaymentStatuses;

class PaymentStatusesController extends Controller
{
    public function test() {
        $post = PaymentStatuses::all()->toArray();
        dd($post);
    }
}
