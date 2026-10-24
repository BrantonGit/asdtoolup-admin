<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Http\Request;
use TradeInTradeUp\Submissions;
use TradeInTradeUp\Certificates;
use TradeInTradeUp\User;
use TradeInTradeUp\PaymentSection;
use TradeInTradeUp\PaymentStatuses;
use TradeInTradeUp\PaymentMethods;
use Auth;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $submissionCount = Submissions::count();

        $paymentCount = PaymentSection::count();
        $certificateCount = Certificates::count();
        $userCount = User::count();

        $rebate_end = new Carbon('2019-12-31 00:00:00');
        $daysLeft = (int) $rebate_end->diffInDays();
        

        $paidSubmissions = Submissions::select()->where('status', 4)->where('payment_status', 2)->get()->pluck('totalAmount')->toArray();
        $paidRebateVal = array_sum($paidSubmissions);
        $paymentsOwed = Submissions::select()->where('status', 4)->get()->pluck('totalAmount')->toArray();
        $paymentsOwedVal = array_sum($paymentsOwed);
   
        // $submissions = Submissions::select()->where('payment_status', 2)->with(['tradeups' => function ($query) {
        //     $query->with(['tradedupuploaded' => function($query){
        //         $query->with(['attached_product' => function($query){$query->with('attached_category');}]);
        //        }])->with('status_state');
        // }])->get()->pluck('tradeups.tradedupuploaded')->first();
        // return $submissions;
        //We still need to count products sold and the sales goal. TBD.

        $submissions = Submissions::select()->with('author')->with('submission_status')->limit(5)->orderBy('updated_at', 'desc')->get();
        $payments = PaymentSection::select()->with(['submission' => function($query){
            $query->with('author')->with('payment_state');
        }])->limit(5)->orderBy('created_at', 'desc')->get();
        $users = User::select()->where('role', 0)->orderBy('created_at', 'desc')->get();

        $submissionsAccepted = Submissions::where('status', 4)->count();
        $totalSubmissions = Submissions::count();
        if($paymentsOwedVal != 0){
            $paymentPercent =  round($paidRebateVal * 100 / $paymentsOwedVal);
        } else {
            $paymentPercent = 0;
        }
    //    return $paymentPercent;
        //Array = [Accepted, Total, Percentage]
    
        if($totalSubmissions != 0) {
            $acceptanceRate = [$submissionsAccepted, $totalSubmissions, round($submissionsAccepted * 100 / $totalSubmissions)];
        } else {
            $acceptanceRate = [0,0,0];
        }
        
        if(Auth::User()->role !== 0){
            return view('dashboard', ['submissions'=>$submissions, 'certificates'=> $certificateCount, 'payments'=>$payments, 'users'=>$users,'acceptanceRate' => $acceptanceRate, 'paymentPercent' => $paymentPercent, 'paymentsOwed'=> $paymentsOwedVal ,'paidRebateVal'=>$paidRebateVal, 'userCount' => $userCount, 'submissionCount' => $submissionCount, 'paymentCount' => $paymentCount, 'daysLeft' => $daysLeft]);
        } else {
            return redirect('/submissions');
        }

    }

    public function testreturn(){
        // $value = Cookie::get('tradeup_session');
        // $value = Cookie::get('fall_protection_trade_in_trade_up_session');
        
        // $value = Cookie::get('USER_NAME');
        // return $value;
        return 'This basic test works';
    }
}
