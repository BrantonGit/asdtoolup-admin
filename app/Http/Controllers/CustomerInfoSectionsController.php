<?php

namespace TradeInTradeUp\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use TradeInTradeUp\Submissions;
use TradeInTradeUp\ReceiptSections;
use TradeInTradeUp\ReceiptSectionSubmission;
use TradeInTradeUp\TradedupSections;
use TradeInTradeUp\TradedupSectionSubmission;
use TradeInTradeUp\TradedinSections;
use TradeInTradeUp\TradedinSectionSubmission;
use TradeInTradeUp\CustomerInfoSections;
use TradeInTradeUp\Statuses;
use TradeInTradeUp\Reasons;
use TradeInTradeUp\PaymentStatuses;
use TradeInTradeUp\HistoryStages;
use TradeInTradeUp\HistoryStageSubmission;
use Illuminate\Support\Facades\Mail;
use TradeInTradeUp\Mail\RebateUpdate;
use Auth;

class CustomerInfoSectionsController extends SubmissionsController
{
    public function edit($id) {
        $submission = Submissions::select()->where('id', $id)
        ->with('author')
        ->with('submission_status')
        ->with(['customerInfo' => function ($query) {
            $query->with('status_state');
        }])->first();
        // return $submission;
        return view('editInfo', ['submission' => $submission,
            'editType' => "customer-info"
        ]);
    }
    public function updateApi(Request $request){
        // return $request;
     
        if($request->input('lang') == 'fr'){
            $lang = "fr";
        } else {
            $lang = "en";
        }
        $user = Auth::User();
   // Mail::to('lucas@branton.ca')->send(new RebateUpdate("Test", "Test message", 10, $user, "en"));
     //   return;
        if($user){
            //If user, check to see if user id is equal to author id. If not, then it is not their rebate.
            if(Auth::id() == $request->input('author')){ 
            if(!$this->isClosed($request->input('submission_id'))){
                $submission = $this->getSubmissionData($request->input('submission_id'));
                if($submission->customerInfo->status_state->status == "Approved"){
                    return response("Your info has already been approved.", 403);
                } elseif($submission->customerInfo->status_state->status == "Declined") {
                    return response("Your info has already been declined.", 403);
                }
                // return $request;
                $messages = [
                    'required' => 'The :attribute field is required.',
                    'mimes' => 'File Type must be in jpeg,jpg,png.',
                    'image' => 'The file must be an image file with the type jpeg, jpg, png.',
                    'max' => 'Please upload a file under 5MB for :attribute',
                ];

                $attributes = [
                    'fname' => 'first name',
                    'lname' => 'last name',
                    'receipt.*' => 'receipts',
                    'tradeup.*' => 'Tool Ups',
                    'tradein.*' => 'trade ins'
                ];
                
                $validator = Validator::make($request->all(), [
                    'customerInfo.fname'=> 'required',
                    'customerInfo.lname'=> 'required',
                    'customerInfo.email'=> 'required',
                    'customerInfo.phone'=> 'required',
                    'customerInfo.company'=> 'required',
                    'customerInfo.profession'=> 'required',
                    'customerInfo.address'=> 'required',
                    'customerInfo.city'=> 'required',
                    'customerInfo.postal'=> 'required',
                ], $messages, $attributes);

                if($validator->fails()){
                    return response()->json(['errors'=>$validator->errors()->all()], 403);
                }

               
               $newCustomerInfo = $this->customerInfo($request, $submission);

               $submission->update(['customerinfo_section_id' => $newCustomerInfo]);
               $submission->save();

               $newSubmission = $this->getSubmissionData($request->input('submission_id'));
               $historyStage = $this->historyFullSubmission($newSubmission, "Customer info updated", "Renseignements sur le client mis à jour");

            //Reset submission status to pending since it's been updated.
               $reset = $this->resetSubmissionStatus($newSubmission);
            } 
            } else {
                return response("Rebate does not belong to this user.", 401);
            }
        } else{
            return;
        }
        $subid = $submission->id;
        if($lang == "fr"){
            $mes = "Les renseignements relatifs à votre facturation ont été mis à jour.";
            $sub = "Remise mise à jour";
        } else {
            $mes = "Your billing information has been updated.";
            $sub = "Rebate Updated";
        }
        if(!$user->notifications == 0){
           Mail::to($user)->send(new RebateUpdate($sub, $mes, $subid, $user, $lang));
        }
        return response(["en_message" => "Your changes have been made!", "fr_message" => "Vos modifications ont été apportées!"], 200);

    }
    public function update($id, Request $req) {
        if($this->isCustomer() && !$this->isClosed($id)){
            $submission = $this->getSubmissionData($id);
            $user = Auth::user();

            $messages = [
                'required' => 'The :attribute field is required.'
            ];
            
            $attributes = [
                'fname' => 'first name',
                'lname' => 'last name',
                'receipt.*' => 'receipts',
                'tradeup.*' => 'Tool Ups',
                'tradein.*' => 'trade ins'
            ];

            //Return each section here.
            //Each function will create its own tables and return the table id.
            $validator = Validator::make($req->all(), [
                'fname'=> 'required',
                'lname'=> 'required',
                'email'=> 'required',
                'phone'=> 'required',
                'company'=> 'required',
                'profession'=> 'required',
                'address'=> 'required',
                'city'=> 'required',
                'postal'=> 'required'
            ], $messages, $attributes);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Create new section. Function is extended from Submission and returns the newly created section's ID.
            $newCustomerInfo = $this->customerInfo($req, $submission);
            $submission->update(['customerinfo_section_id' => $newCustomerInfo]);
            $submission->save();

            //For some reason ->save() does not update the variable and we need to gather it's data again after it's been updated.
            $newSubmission = $this->getSubmissionData($id);
            $historyStage = $this->historyFullSubmission($newSubmission, "Customer info updated", "Renseignements sur le client mis à jour");
            
            return redirect('/submissions/'.$submission->id);
        } else {
            abort(403);
        }
    }
}
