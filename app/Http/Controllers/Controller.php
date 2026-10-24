<?php

namespace TradeInTradeUp\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use TradeInTradeUp\Submissions;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function isCustomer(){
        //Simple check to see who is asking to do this function.
        //This may need to change to check for admin. Since, 
        $user = Auth::user();
        $customer = false;
        if($user->role == 0){
            $customer = true;
        }
        return $customer;
    }

    protected function isMaster(){
        $user = Auth::user();
        $master = false;
        if($user->role == 2){
            $master = true;
        }
        return $master;
    }

    protected function getSubmissionData($id){
        $submission = Submissions::select()->where('id', $id)
         ->with('author')
         ->with('submission_status')
         ->with('receipt_files')
         ->with('tradein_files')
         ->with('payment_state')
         ->with(['customerInfo' => function ($query) {
             $query->with('status_state');
         }])
         ->with(['receipts' => function ($query) {
             $query->with('receiptsuploaded')->with('status_state');
         }])
         ->with(['tradeins' => function ($query) {
             $query->with('tradeinuploaded')->with('status_state')->with(['brands_section'=>function($query){
                 $query->with(['brands_submissions' => function($query){
                     $query->with('brand_title');
                 }]);
             }])->with('tradein_products');
         }])
         ->with(['tradeups' => function ($query) {
             $query->with(['tradedupuploaded' => function($query){
                 $query->with(['attached_product' => function($query){$query->with('attached_category');}]);
                }])->with('status_state');
         }])
         ->with(['history_stages' => function($query) {
             $query->with(["history_stages_submission" => function($query) {
                 $query->with(['author'=>function($q){
                    $q->select('id','fname','lname','role');
                 }])->with(['customerinfo_section' => function($q){$q->select('id','comments','status', 'reason_id')->with('status_state');}])
                 ->with(['receipt_section' => function($q){$q->select('id','comments','status', 'reason_id')->with('status_state');}])
                 ->with(['tradedin_section' => function($q){$q->select('id','comments','status', 'reason_id')->with('status_state');}])
                 ->with(['tradedup_section' => function($q){$q->select('id','comments','status', 'reason_id')->with('status_state');}]);
             }]);
         }])->first();

         foreach($submission->receipt_files as $file){
             $file->link = 'uploads/' . $file->folder . '/' . $file->projectid . '/' . $file->intake . '/' . $file->name;
         }

         foreach($submission->tradein_files as $file){
            $file->link = 'uploads/' . $file->folder . '/' . $file->projectid . '/' . $file->intake . '/' . $file->name;
        }

         return $submission;
     }
}
