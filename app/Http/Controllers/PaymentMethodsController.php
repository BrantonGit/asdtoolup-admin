<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\PaymentMethods;

class PaymentMethodsController extends Controller
{
    public function test() {
        $post = PaymentMethods::all()->toArray();
        dd($post);
    }
}
