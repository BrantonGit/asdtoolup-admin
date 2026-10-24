<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\ReceiptSectionSubmission;

class ReceiptSectionSubmissionController extends Controller
{
    public function test() {
        $post = ReceiptSectionSubmission::all()->toArray();
        dd($post);
    }
}
