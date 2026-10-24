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

class TradedinSectionsController extends SubmissionsController
{
    public function __construct(){
        
    }
    public function edit($id) {
        $submission = Submissions::select()->where('id', $id)
        ->with('author')
        ->with('submission_status')
        ->with(['tradeins' => function ($query) {
            $query->with('tradeinuploaded')->with('status_state');
        }])->first();
        // return $submission;
        return view('editInfo', ['submission' => $submission,
            'editType' => "trade-in-info"
        ]);
    }
    public function updateApi(Request $request){
        // return $request;
        $user = Auth::User();
        // return $request;

        //DECODE THE JSON AND GET THE COUNT
        $l = json_decode($request->input('tradeinProducts'));
        // return $l;
        $num = count($l);
        //Check if the column is empty for each. If none are empty, the number should equal $num
        $pqty = count(array_filter(array_column($l,'product_qty')));
        $pnum = count(array_filter(array_column($l,'product_number')));
        $pbrand = count(array_filter(array_column($l,'brand')));
        // return $num;
        // if(!($pqty == $num && $pbrand == $num && $pnum == $num)){
        //     return response("Please fill out all your fields.", 403);
        // }

        if($user){
            $decoded = json_decode($request->submissionInfo, true);
            $request->merge($decoded);
            $decoded2 = json_decode($request->input('tradeinProducts'), true);
            // $decoded3 = json_encode($decoded2);
            $request->merge(['tradeinProducts'=>$decoded2]);
    
    
            //VALIDATION FOR IF ANY FILES HAVE BEEN UPLOADED
            //DEPENDING ON THE BRAND SITUATION, YOU MIGHT NEED TO REMOVE THIS
            //USERS MIGHT EDIT BRANDS BUT NOT PHOTOS.
            // if(!$request->hasFile('tradein')){
            //     return response("You have not uploaded any new photos.", 403);
            // }
            $decoded1 = json_decode($request->input('brands'), true);
            $request->merge(['brands'=>$decoded1]);
            if($request->input('lang') == 'fr'){
                $lang = "fr";
            } else {
                $lang = "en";
            }
            $submission = $this->getSubmissionData($request->submission_id);
        if($submission->author->id == Auth::id()){
            if(!$this->isClosed($request->submission_id)){
                //Allowed

                // $submission = $this->getSubmissionData($request->input('submission_id'));
                // return $submission->receipts->status_state->status;
                // return $submission->tradeins->status_state->status;
                // return "trade ". $submission->tradeups->status_state->status;
                if($submission->tradeins->status_state->status == "Approved"){
                    return response("Your info has already been approved.", 403);
                } elseif($submission->tradeins->status_state->status == "Declined") {
                    return response("Your info has already been declined.", 403);
                }

                $newTradeIn = $this->tradedinInfo($request, $submission);
                $submission->update(['tradedin_section_id' => $newTradeIn]);
                $submission->save();
                
                //For some reason ->save() does not update the variable and we need to gather it's data again after it's been updated.
                $newSubmission = $this->getSubmissionData($request->submission_id);
                $historyStage = $this->historyFullSubmission($newSubmission, "Trade in photos updated", "Photos de l’échange mises à jour");

                //Reset submission status to pending since it's been updated.
                $reset = $this->resetSubmissionStatus($newSubmission);
            }
        } else  {
            return response("Rebate does not belong to this user.", 401);
        }
        }
        $subid = $submission->id;
        
        if($lang == "fr"){
            $mes = "Les photos de votre échange et les marques ont été mises à jour.";
            $sub = "Remise mise à jour";
        } else {
            $mes = "Your trade-in photos & brands have been updated.";
            $sub = "Rebate Updated";
        }
        if(!$user->notifications == 0){
            Mail::to($user)->send(new RebateUpdate($sub, $mes, $subid, $user, $lang));
        }
        return response(["en_message" => "Your changes have been made!", "fr_message" => "Vos modifications ont été apportées!"], 200);
    }
    public function update($id, Request $req) {
        if($this->isCustomer() && !$this->isClosed($id) && $this->appliesTo($id)){
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
            'tradein' => 'required',
            'tradein.*' => 'required|max:5120|image|mimes:png,jpeg,jpg'
        ], $messages, $attributes);

        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        //Create new section. Function is extended from Submission and returns the newly created section's ID.
        $newTradeIn = $this->tradedinInfo($req, $submission);
        $submission->update(['tradedin_section_id' => $newTradeIn]);
        $submission->save();
        
        //For some reason ->save() does not update the variable and we need to gather it's data again after it's been updated.
        $newSubmission = $this->getSubmissionData($id);
        $historyStage = $this->historyFullSubmission($newSubmission, "Trade in photos updated", "Photos de l’échange mises à jour");

        // return $submission;
        
        return redirect('/submissions/'.$submission->id);
        } else {
            abort(403);
        }
    }
}
