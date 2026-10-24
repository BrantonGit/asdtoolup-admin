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

class TradedupSectionsController extends SubmissionsController
{
    public function edit($id) {
        $submission = Submissions::select()->where('id', $id)
        ->with('author')
        ->with('submission_status')
        ->with(['tradeups' => function ($query) {
            $query->with('tradedupuploaded')->with('status_state');
        }])->first();

        return view('editInfo', ['submission' => $submission,
            'editType' => "trade-up-info"
        ]);
    }
    public function updateApi(Request $request){
        if($request->input('lang') == 'fr'){
            $lang = "fr";
        } else {
            $lang = "en";
        }
        $user = Auth::User();
        if($user){
        $submission = $this->getSubmissionData($request->submission_id);
        if($submission->author->id == Auth::id()){
            // return $request;
                  // $submission = $this->getSubmissionData($request->input('submission_id'));
                // return $submission->receipts->status_state->status;
                // return $submission->tradeins->status_state->status;
                // return "trade ". $submission->tradeups->status_state->status;
            if($submission->tradeups->status_state->status == "Approved"){
                return response("Your info has already been approved.", 403);
            } elseif($submission->tradeups->status_state->status == "Declined") {
                return response("Your info has already been declined.", 403);
            }
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
                'tradein.*' => 'trade ins',
                'tradeup.*.quantity' => 'product quantity'
            ];
    
            $validator = Validator::make($request->all(), [
                'tradeup' => 'required',
                'tradeup.*.quantity' => 'required'
            ], $messages, $attributes);
    
            if($validator->fails()) {
                return response()->json(['errors'=>$validator->errors()->all()], 422);
            }

            if(!$this->isClosed($request->submission_id)){
                $newTradeUpSection = $this->tradedupInfo($request, $submission);
                // return $newTradeUpSection;
                $submission->update(['tradedup_section_id' => $newTradeUpSection]);
                $submission->save();
                $newSubmission = $this->getSubmissionData($request->submission_id);
                $historyStage = $this->historyFullSubmission($newSubmission, "Tool Up photos updated", "Photos de l’échange mises à jour");
            }
        } else {
            return response("Rebate does not belong to this user.", 401);
        }
      
    } else {
        return;
    }
        $subid = $submission->id;
        if($lang == "fr"){
            $mes = "Les produits de votre échange ont été mis à jour.";
            $sub = "Remise mise à jour";
        } else {
            $mes = "Your trade-up products have been updated.";
            $sub = "Rebate Updated";
        }
        // return $user->notifications;
        if(!$user->notifications == 0){
            Mail::to($user)->send(new RebateUpdate($sub, $mes, $subid, $user, $lang));
        }
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
            'max' => 'Please upload a file under 5MB.',
        ];
        $attributes = [
            'fname' => 'first name',
            'lname' => 'last name',
            'receipt.*' => 'receipts',
            'tradeup.*' => 'Tool Ups',
            'tradein.*' => 'trade ins'
        ];

        $validator = Validator::make($req->all(), [
            'tradeup' => 'required',
            'tradeup.*' => 'required|max:5120|image|mimes:png,jpeg,jpg'
        ], $messages, $attributes);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
         //Create new section. Function is extended from Submission and returns the newly created section's ID.
        $newTradeUpSection = $this->tradedupInfo($req, $submission);
        $submission->update(['tradedup_section_id' => $newTradeUpSection]);
        $submission->save();
        $newSubmission = $this->getSubmissionData($id);
        $historyStage = $this->historyFullSubmission($newSubmission, "Tool Up photos updated", "Photos de l’échange mises à jour");
        return redirect('/submissions/'.$submission->id);
        } else {
            abort(403);
        }
    }
}
