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
use TradeInTradeUp\PaymentStatuses;
use TradeInTradeUp\HistoryStages;
use TradeInTradeUp\HistoryStageSubmission;
use Illuminate\Support\Facades\Mail;
use TradeInTradeUp\Mail\RebateUpdate;
use Auth;

class ReceiptSectionsController extends SubmissionsController
{
    public function edit($id) {
        $submission = Submissions::select()->where('id', $id)
        ->with('author')
        ->with('submission_status')
        ->with(['receipts' => function ($query) {
            $query->with('receiptsuploaded')->with('status_state');
        }])->first();
        
        return view('editInfo', ['submission' => $submission, 'editType' => "receipt-info"]);
    }
    public function updateApi(Request $request){
        $decoded = json_decode($request->submissionInfo, true);
        $request->merge($decoded);
        // $decoded2 = json_decode($request->input('receiptProducts'), true);
        // // $decoded3 = json_encode($decoded2);
        // $request->merge(['receiptProducts'=>$decoded2]);
        // return gettype($request->input('receiptProducts'));
        // return sizeof($request->input('receiptProducts'));
        $submission = $this->getSubmissionData($request->submission_id);
    
        if($request->input('lang') == 'fr'){
            $lang = "fr";
        } else {
            $lang = "en";
        }
       
        $user = Auth::User();
        if($user){
        if($submission->author->id == Auth::id()){
                if($submission->receipts->status_state->status == "Approved"){
                    return response("Your info has already been approved.", 403);
                } elseif($submission->receipts->status_state->status == "Declined") {
                    return response("Your info has already been declined.", 403);
                }
            if(!$this->isClosed($request->submission_id)){
            //     $messages = [
            //         'required' => 'The :attribute field is required.',
            //         'mimes' => 'File Type must be in jpeg,jpg,png.',
            //         'image' => 'The file must be an image file with the type jpeg, jpg, png.',
            //         'max' => 'Please upload a file under 5MB.'
            //     ];
            //     $attributes = [
            //         'receipt.*' => 'receipts',
            //     ];
        
            //     $validator = Validator::make($request->all(), [
            //         'receipt' => 'required',
            //         'vendor' =>'required',
            //         'receipt.*' => 'required|max:5120|image|mimes:png,jpeg,jpg'
            //     ], $messages, $attributes);
        
            //     if($validator->fails()) {
            //         return response()->json(['errors'=>$validator->errors()->all()], 422);
            //     }

                $newReceipt = $this->receiptInfo($request, $submission);
                $submission->update(['receipts_section_id' => $newReceipt]);
                $submission->save();
                
                //For some reason ->save() does not update the variable and we need to gather it's data again after it's been updated.
                $newSubmission = $this->getSubmissionData($request->submission_id);
                $historyStage = $this->historyFullSubmission($newSubmission, "Receipts updated", "Reçus mis à jour");
                
                //Reset submission status to pending since it's been updated.
                $reset = $this->resetSubmissionStatus($newSubmission);
            }
        } else{
            return response("Rebate does not belong to this user.", 401);
        }
    } else {
        return;
    }
    $subid = $submission->id;
    // $mes = "Your receipt photos & vendor have been updated.";

    if($lang == "fr"){
        $mes = "Les photos de votre reçu et le fournisseur ont été mis à jour.";
        $sub = "Remise mise à jour";
    } else {
        $mes = "Your receipt photos, products & vendor have been updated.";
        $sub = "Rebate Updated";
    }
    if(!$user->notifications == 0){
        Mail::to($user)->send(new RebateUpdate($sub, $mes, $subid, $user, $lang));
    }
        // return $request;
        return response(["en_message" => "Your changes have been made!", "fr_message" => "Vos modifications ont été apportées!"], 200);
    }

    public function update($id, Request $req) {
        if($this->isCustomer() && !$this->isClosed($id)){
        //Inherited function from SubmissionController
        $submission = $this->getSubmissionData($id);
        $user = Auth::user();

        $messages = [
            'required' => 'The :attribute field is required.',
            'mimes' => 'File Type must be in jpeg,jpg,png.',
            'image' => 'The file must be an image file with the type jpeg, jpg, png.',
            'max' => 'Please upload a file under 5MB.'
        ];
        $attributes = [
            'fname' => 'first name',
            'lname' => 'last name',
            'receipt.*' => 'receipts',
            'tradeup.*' => 'Tool Ups',
            'tradein.*' => 'trade ins'
        ];

        $validator = Validator::make($req->all(), [
            'receipt' => 'required',
            'receipt.*' => 'required|max:5120|image|mimes:png,jpeg,jpg'
        ], $messages, $attributes);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //Create new section. Function is extended from Submission and returns the newly created section's ID
        $newReceipt = $this->receiptInfo($req, $submission);
        $submission->update(['receipts_section_id' => $newReceipt]);
        $submission->save();

        //For some reason ->save() does not update the variable and we need to gather it's data again after it's been updated
        $newSubmission = $this->getSubmissionData($id);
        $historyStage = $this->historyFullSubmission($newSubmission, "Receipts updated", "Reçus mis à jour");
        
        return redirect('/submissions/'.$submission->id);
    } else {
        abort(403);
    }
}
}
