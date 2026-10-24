<?php

namespace TradeInTradeUp\Http\Controllers;

use Auth;
use Redirect;
use Illuminate\Http\Request;
use TradeInTradeUp\PaymentSection;
use TradeInTradeUp\PaymentStatuses;
use TradeInTradeUp\PaymentMethods;
class PaymentSectionController extends SubmissionsController
{
    //
    public function allPayments(request $request){


        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
            } 

        $user = Auth::user();
        $paymentStatuses = PaymentStatuses::select()->get();

        if(strlen($request->input('sort_status')) > 0){
            $status = $request->input('sort_status');
        } else {
            $status = 0;
        }
        if(strlen($request->input('sort_date')) > 0){
            $date = $request->input('sort_date');
        } else{
            $date = "newest";
        }
        if($date == 'oldest'){
            $ord = 'ASC';
        } else {
            $ord = 'DESC';
        }
        if(strlen($request->input('sort_count')) > 0){
            $count = $request->input('sort_count');
        } else{
            $count = 10;
        }
        $default = PaymentSection::select()->with(['submission' => function($query){
            $query->with('author')->with('payment_state');
        }])->orderBy('created_at', $ord)->paginate($count);
    
        if($status){
            if($status !== 0){
                $payments = PaymentSection::select()->whereHas('submission', function($query) use ($status){
                    $query->with('author')->whereHas('payment_state', function($query) use ($status){
                        $query->where('id', $status);
                    });
                })->orderBy('created_at', $ord)->paginate($count);
            }
        } else {
            $payments = $default;
        }
        return view('payments', ['payments' => $payments, 'statuses' => $paymentStatuses, 'selected_status'=>$status, 'selected_date1'=>$date, 'selected_count'=>$count]);
    }


    public function exportPurchases(){

        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
        }

        $payments = PaymentSection::with(['submission' => function($query){
            $query->with('author')->with('payment_state')->with('customerInfo');
        }])->orderBy('created_at', 'DESC')->get();

        $filename = 'asdtoolup-purchases-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'no-store, no-cache',
        ];

        $columns = [
            'Payment ID',
            'Submission ID',
            'Customer First Name',
            'Customer Last Name',
            'Customer Email',
            'Company',
            'Published',
            'Status',
            'Purchase Value (CAD)',
            'Remaining Value (CAD)',
        ];

        $callback = function() use ($payments, $columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            foreach ($payments as $payment) {
                $sub      = $payment->submission;
                $customer = $sub ? $sub->customerInfo : null;
                $state    = $sub ? $sub->payment_state : null;

                fputcsv($out, [
                    $payment->id,
                    $sub ? $sub->id : '',
                    $customer ? $customer->fname : '',
                    $customer ? $customer->lname : '',
                    $customer ? $customer->email : '',
                    $customer ? $customer->company : '',
                    $payment->created_at ? $payment->created_at->format('Y-m-d') : '',
                    $state ? $state->status : '',
                    $payment->payment_amount_cad,
                    $payment->remainingvalue,
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }


    public function getPayment($id){


        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
            } 

        $payment = PaymentSection::select()->where('id', $id)->with(['submission' => function($query){
            $query->with('author')->with('payment_state')->with('submission_status');
        }])->first();
        $methods = PaymentMethods::select('id', 'method')->get();
        $statuses = PaymentStatuses::select('id', 'status')->get();

        return view('payment', ['payment' => $payment, 'methods' => $methods, 'statuses' => $statuses]);
    }



    public function updatePayment($id, request $req){


        
        if(!$this->isCustomer()){
            $payment = PaymentSection::select()->where('id', $id)->first();

            $payment->payment_amount_cad = $req->input('purchasevalue');
            $payment->remainingvalue = $req->input('remainingvalue');
            $payment->save();
            $submission = $this->getSubmissionData($payment->submission_id);
            // return $submission;
            $submission->update([
                'payment_status' => $req->input('status'),
                'payment_amount_cad' => $req->input('purchasevalue'),
                'remainingvalue' => $req->input('remainingvalue')
            ]);
            $submission->save();
            
            if($submission->payment_status == 2){
                $closed = $this->closeSubmission($submission->id);
                return redirect('/submissions/'.$submission->id);
            } else {
                return redirect('/submissions/'.$submission->id);
            }
        } else {
            abort(403); 
        }
    }

        
    public function deletePayment($id) {
        
    
        if(Auth::user()->id == 87) {
        $payment = PaymentSection::select()->where('id', $id)->delete();
         }
        return redirect('/payments');
    
    }
}
