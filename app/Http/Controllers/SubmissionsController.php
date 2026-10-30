<?php

namespace TradeInTradeUp\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use TradeInTradeUp\Submissions;
use TradeInTradeUp\ReceiptSections;
use TradeInTradeUp\ReceiptSectionSubmission;
// use TradeInTradeUp\ReceiptProducts;
use TradeInTradeUp\TradeInProducts;
use TradeInTradeUp\TradedupSections;
use TradeInTradeUp\TradedupSectionSubmission;
use TradeInTradeUp\TradedinSections;
use TradeInTradeUp\TradedinSectionSubmission;
use TradeInTradeUp\CustomerInfoSections;
use TradeInTradeUp\Statuses;
use TradeInTradeUp\Reasons;
use TradeInTradeUp\Certificates;
use TradeInTradeUp\Rewards;
use TradeInTradeUp\RewardOptions;
use TradeInTradeUp\Products;
use TradeInTradeUp\ProductCategories;
use TradeInTradeUp\PaymentStatuses;
use TradeInTradeUp\PaymentSection;
use TradeInTradeUp\HistoryStages;
use TradeInTradeUp\Brands;
use TradeInTradeUp\FileUpload;
use TradeInTradeUp\BrandSections;
use TradeInTradeUp\BrandSectionSubmission;
use TradeInTradeUp\HistoryStageSubmission;
use TradeInTradeUp\User;
use Illuminate\Support\Facades\Mail;
use TradeInTradeUp\Mail\RebateUpdate;
use TradeInTradeUp\Mail\RebateUpdatePayment;
use TradeInTradeUp\Mail\RebateUpdateAdmin;
use TradeInTradeUp\Mail\CertificateAdmin;
use Illuminate\Support\Facades\Storage;
use Auth;
use PDF;
use Redirect;
use Carbon\Carbon;

// use Excel;
// use TradeInTradeUp\Exports\InvoiceValue;

// use Illuminate\Contracts\Encryption\DecryptException;
// use Illuminate\Support\Facades\Crypt;

class SubmissionsController extends Controller
{
    public function __construct()
    {
        //I think we only need to do this here to check for verification
        // $this->middleware('auth');
    }


        //Get All Submissions
        public function allSubmissions(request $request){

            if(Auth::User()->role == 0){
                Auth::logout();
                return Redirect::to('https://asdtoolup.3mcanada.ca/');
                } 

            $statuses = Statuses::select()->get();
    
            if(strlen($request->input('sort_status')) > 0){
                $status = $request->input('sort_status');
            } else {
                $status = 0;
            }
            if(strlen($request->input('sort_date')) > 0){
                $date = $request->input('sort_date');
            } else {
                $date = "newest";
            }
            if($date == 'oldest'){
                $ord = 'ASC';
                $orderBy = 'created_at';
            } else {
                $ord = 'DESC';
                $orderBy = 'created_at';
            }
    
            if($date == 'lastupdated'){
                $ord = 'ACS';
                $orderBy = 'updated_at';
            }
    
            if(strlen($request->input('sort_count')) > 0){
                $count = $request->input('sort_count');
            } else{
                $count = 10;
            }
    
            $default = Submissions::select()->with('author')->with('customerInfo')->with('submission_status')->orderBy($orderBy, $ord)->paginate($count);
        
            if($status){
                if($status != 0){
                    $submissions = Submissions::select()->where('status','like', $status)->with('author')->with('customerInfo')->with('submission_status')->orderBy('created_at', $ord)->paginate($count);
                } else {
                    $submissions = $default;
                }
            } else{
                $submissions = $default;
            }
            return view('submissions', ['submissions' => $submissions, 'statuses' => $statuses, 'selected_status'=>$status, 'selected_date'=>$date, 'selected_count'=>$count]);
        }


            //Get a Single Submission
    public function getSubmission($id){


        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
            } 

        
        if(Auth::user()){
        $user = Auth::user();
        } 
        
        if($this->isCustomer()){
            $userRole = "Customer";
        } else {
            $userRole = "Admin";
        }

        $payment= PaymentSection::select()->where('submission_id', $id)->first();
        if(!$payment){
            $payid = "none";
        } else {
            $payid = $payment->id;
        }
        $statuses = Statuses::select('id','status')->get();
        $submission = $this->getSubmissionData($id);
        // return $submission;
        $receiptuploads = FileUpload::where('projectid', $id)->where('intake', 'receipt')->where('size', 'inuse')->get();
        $history = $submission->history_stages;
        $reasons = Reasons::select('id', 'reason')->get();

        // return $submission;

        return view('submission', [
            'submission' => $submission,
            'history' => $history,
            'receipts' => $receiptuploads,
            'user' => $userRole,
            'payment'=> $payment,
            'statuses' => $statuses,
            'reasons' => $reasons,
            'payid' => $payid
        ]);
    }

       //Submit Form
    public function createSubmission(Request $request) {
 

        // $encrypted = Crypt::encrypt('rodney@branton.ca');
        // $decrypted = Crypt::decryptString($encrypted);
        // return $encrypted . ' --- ' . $decrypted;


        //Create initial submission container
         //return $request;
        $decoded = json_decode($request->input('customerInfo'), true);
        $request->merge(['customerInfo'=>$decoded]);
      
        // return $request->receiptProducts[0]['product_number'];
        if(Auth::User()){
            $user = User::select()->where('id', Auth::id())->first();
        } else {
            return $request;
        }

        // return $request->input('customerInfo.lang');
        $lang = $request->input('customerInfo.lang');


        $submission = new Submissions([
            'customer_id' => $user->id,
            'status' => 1,
            'active' => 1
        ]);
        $submission->save();

        $customerSection = $this->customerInfo($request, $submission);
        $receiptSection = $this->receiptInfo($request, $submission);
        
        //Let's calculate the TOTAL rebate value here once the $tradedupSection has been created;
        // $allRebates = TradedupSectionSubmission::select()->where('tradedup_section_id', $tradedupSection)->get()->pluck("value")->toArray();
        // $rebateValue = array_sum($allRebates); //This is the total amount in CAD

        $history = new HistoryStages([
            'submission_id' => $submission->id,
            'author_id' => $user->id
        ]);
        $history->save();
        $submission->update([
            'customerinfo_section_id' => $customerSection,
            'receipts_section_id' => $receiptSection,
            'history_stages_id' => $history->id,
            'totalAmount' => '0'
        ]);
        $submission->save();
        $historyStage = $this->historyFullSubmission($this->getSubmissionData($submission->id), "Submission created", "Demande créée");
        $subid = $submission->id;
        $mes = "Your submission has been created!";

        $mes2 = "A Tool Up submission has been created. Please review the submission on the admin portal.";
        $sub = "Submission Created";

        // Notifications must never fail the submission: by this point the
        // submission, customer info, receipts and history are already saved.
        // A mail/SMTP outage used to return a 500, which made customers
        // resubmit and create duplicates.
        try {
            if($user->notifications != 0){
                Mail::to($user)->send(new RebateUpdate($sub, $mes, $subid, $user, $lang));
            }

            Mail::to('ian@branton.ca')->send(new RebateUpdateAdmin($sub, $mes2, $subid, 'Rodney', $lang));
            Mail::to('melanie@accellgraphics.com')->send(new RebateUpdateAdmin($sub, $mes2, $subid, 'Melanie', $lang));
        } catch (\Throwable $e) {
            report($e);
        }

        return $submission->id;
    }


    //SEND MORE DATA HERE - TRAINUP
    public function getCustomersRebate(Request $request, $currency){
        //Need authentication to identify what user this is. 
        //For now we will use filler.
        $uid = Auth::id();

        // return $currency;
        // $submissions = Submissions::select()->where('customer_id', $uid)->with('author')->with('customerInfo')->with('payment_section')->with('submission_status')->orderBy('created_at', 'DESC')->paginate(20);
        // return $submissions;

        if($currency == 'en' || $currency == 'fr') {
        $submissions = Submissions::whereHas('customerInfo', function($query) use ($currency)  {
            $query->where('country', 'ca');
         })->where('customer_id', $uid)->with('author')->with('customerInfo')->with('payment_section')->with('submission_status')->orderBy('created_at', 'DESC')->paginate(20);
        }
        return $submissions;
        // ->with('payment_section')->with('submission_status')->orderBy('created_at', 'DESC')->paginate(20);
    }



    public function getCustomersCertificates(Request $request){
     
        $uid = Auth::id();
        $certificates = Certificates::where('userid', $uid)->where('redeemed', 0)->with('reward')->with('option')->orderBy('created_at', 'DESC')->paginate(1000);
    
        foreach($certificates as $certificate) {
        $certificate['issuedate'] = Carbon::parse($certificate->created_at)->translatedFormat('d M Y');
        $certificate['expirydate'] = Carbon::parse($certificate->created_at)->addYear()->translatedFormat('d M Y');     
        }

        return $certificates;
     
    }


    public function authremoveoldfiles(Request $request){

        if(Auth::check()) {
          
            $oldfilePath = '/uploads/'. Auth::user()->email . '/new';
            Storage::disk('local')->deleteDirectory($oldfilePath);
            FileUpload::where('folder', Auth::user()->email)->where('size', 'new')->delete();

        } 
            return;
    }

    public function uploadfiles(Request $request){

        $file = $request;
        $name = $file['name'];
        $filePath = '/uploads/'. $file['identify'] . '/new/' . $file['intake'] . '/' . $name;

        $fileUpload = new FileUpload;
        $fileUpload->name = str_replace("#", "%23", $name);
        $fileUpload->file_name = str_replace("#", "%23", $name);
        $fileUpload->folder = $file['identify'];
        $fileUpload->intake = $file['intake'];
        $fileUpload->size = 'new';
        $fileUpload->rawsize = $file['files'][0]->getSize();
        $fileUpload->kind = $file['files'][0]->getClientOriginalExtension();
        $fileUpload->userid = 0;

        if($file['userid']) {  
            $filePath = '/uploads/'. $file['identify'] . '/' . $file['projectid'] . '/' . $file['intake'] . '/' . $name;
            $fileUpload->userid = $file['userid'];
            $fileUpload->projectid = $file['projectid'];
            $fileUpload->confirmid = $file['projectid'];
            $fileUpload->size = 'inuse';
        }

        Storage::disk('local')->put($filePath, file_get_contents($file['files'][0]));
        $fileUpload->save();

        return $request;
    }

    public function fileremove(Request $request){

        
        if($request['userid']) {  
            $filePath = '/uploads/'. $request['identify'] . '/' . $request['projectid'] . '/' . $request['intake'] . '/' . $request['name'];
            $fileUpload = FileUpload::where('folder',  $request['identify'])->where('name', $request['name'])->where('projectid', $request['projectid'])->where('size', 'inuse')->first();
        } else{
            $filePath = '/uploads/'.  $request['identify'] . '/new/' . $request['intake'] . '/' . $request['name'];
            $fileUpload = FileUpload::where('folder',  $request['identify'])->where('name', $request['name'])->where('size', 'new')->first();
        }
      
        Storage::disk('local')->delete($filePath);
        $fileUpload->delete();
    
        return 'removed';
    
    }



    public function allCertificates(request $request){


        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
            } 

        $certificates = Certificates::with('author')->with('reward')->with('option')->orderBy('created_at', 'DESC')->paginate(1000);

        foreach($certificates as $certificate) {
        $certificate['issuedate'] = Carbon::parse($certificate->created_at)->translatedFormat('d M Y');
        $certificate['expirydate'] = Carbon::parse($certificate->created_at)->addYear()->translatedFormat('d M Y');     
        }

        // return $certificates;

        return view('certificates' ,['certificates' => $certificates]);
    }

    public function exportCertificates(){

        if(Auth::User()->role == 0){
            Auth::logout();
            return Redirect::to('https://asdtoolup.3mcanada.ca/');
        }

        $certificates = Certificates::with('author')->with('reward')->with('option')->orderBy('created_at', 'DESC')->get();

        $filename = 'asdtoolup-certificates-' . date('Y-m-d') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control'       => 'no-store, no-cache',
        ];

        $columns = [
            'Redemption ID',
            'Customer First Name',
            'Customer Last Name',
            'Customer Email',
            'Issue Date',
            'Expiry Date',
            'Product Redeemed',
            'Model',
            'Tier Value',
            'Status',
            'Shipping',
            'Tracking Number',
        ];

        $callback = function() use ($certificates, $columns) {
            $out = fopen('php://output', 'w');
            fputcsv($out, $columns);

            foreach ($certificates as $certificate) {
                $author = $certificate->author;
                $reward = $certificate->reward;
                $option = $certificate->option;

                fputcsv($out, [
                    $certificate->certid,
                    $author ? $author->fname : '',
                    $author ? $author->lname : '',
                    $author ? $author->email : '',
                    $certificate->created_at ? \Carbon\Carbon::parse($certificate->created_at)->format('Y-m-d') : '',
                    $certificate->created_at ? \Carbon\Carbon::parse($certificate->created_at)->addYear()->format('Y-m-d') : '',
                    $reward ? $reward->name : '',
                    $option ? $option->model : '',
                    $certificate->value,
                    $certificate->redeemed == 0 ? 'Enabled' : 'Disabled',
                    $certificate->shipped == 0 ? 'Not Shipped' : 'Shipped',
                    $certificate->tracking,
                ]);
            }

            fclose($out);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getCertificate(request $request, $id){

       $certificate = Certificates::where('certid', $id)->first(); 

       
       
       if($certificate->redeemed == 0){
        $certificate->redeemed = 1;
       }else{
        $certificate->redeemed = 0;
       }

       $certificate->save();
    
       return back()->withErrors(['msg', 'The Message']);

    }

    public function redeemNow(request $request){

        // return 'test';

        $reward = $request['reward'];
        $option = $request['option'];
        $country = 'ca';

        if(Auth::User()){
            $user = User::select()->where('id', Auth::id())->first();
        } else {
            return $request;
        }
        $totalrebate = 0;
        $rebatevalue = 0;
        $status = 1;
        $producttier = 0;

        $payments = Submissions::
        where('customer_id', $user->id)->
        whereHas('customerInfo', function($query) use ($country)  {$query->
            where('country', $country);})->
        whereHas('payment_state', function($query) use ($status){$query->where('id', $status); })->
        with('payment_section')->orderBy('id')->
        get();


        foreach($payments as $purchase) {
            if(isset($purchase->payment_section->remainingvalue )){
            $totalrebate = intval($purchase->payment_section->remainingvalue) + intval($totalrebate);
        }
        }

        $product = Rewards::where('id', $reward)->with('reward_options')->first();
        $productvalue = intval($product->redeemvalue);

        // return $product->redeemvalue . ' - ' . $totalrebate;

        if($product->redeemvalue <= $totalrebate) {
    
            foreach($payments as $purchase) {
                if($productvalue != 0) {
                       if(isset($purchase->payment_section->remainingvalue )){
                    $housevalue = intval($purchase->payment_section->remainingvalue);
                    $purchase->payment_section->remainingvalue = max(intval($purchase->payment_section->remainingvalue) - intval($productvalue), 0);
                    $productvalue = max($productvalue - $housevalue, 0);
                    if($purchase->payment_section->remainingvalue == 0) {
                        $purchase->payment_status = 2;
                    }
                    $purchase->payment_section->save();
                    $purchase->save();
                 }
                }
            }
        } else{
            return $request;
        }
        
        // return $payments;

            $certid = \Illuminate\Support\Str::random(10) . strtoupper($country);

            $certificate = new Certificates([
                'certid' => $certid,
                'value' => $product->redeemvalue,
                'rewardid' => $reward,
                'optionid' => $option,
                'redeemed' => false,
                'userid' => $user->id
            ]);
            $certificate->save();
      

        // $mes = "Your rebate has been created!";
        $mes2 = "A Tool Up Redemption has been created.";
        $sub = "Product Redeemed – ASD Tool Up";
        // $productoption = RewardOptions::where('id', $option)->first();
        // $redeemed = $product->name + ' (' + $productoption->model + ')';

       Mail::to('ian@branton.ca')->send(new CertificateAdmin($sub, $mes2, $certid, $product->name, $country, 'ian@branton.ca', 'Ian', 'en'));
       Mail::to('melanie@accellgraphics.com')->send(new CertificateAdmin($sub, $mes2, $certid, $product->name, $country, 'melanie@accellgraphics.com', 'Melanie', 'en'));


       return $certid;


    }


    protected function customerInfo($req, $container){
        // return $req['fname'];]

        if(!$this->isClosed($container->id)){
        $customerInfo = new CustomerInfoSections([
            "submission_id" => $container->id,
            "status" => 1,
            "fname" => $req->input('customerInfo.fname'),
            "lname" => $req->input('customerInfo.lname'),
            "phone" => $req->input('customerInfo.phone'),
            "email" => $req->input('customerInfo.email'),
            "company" => $req->input('customerInfo.company'),
            "channel" => $req->input('customerInfo.channel'),
            "profession" => $req->input('customerInfo.profession'),
            "address" => $req->input('customerInfo.address'),
            "city" => $req->input('customerInfo.city'),
            "country" => $req->input('customerInfo.country'),
            "postal" => $req->input('customerInfo.postal'),
            "chequeissue"  => $req->input('customerInfo.chequeissue')
        ]);
        $customerInfo->save();
        // return $customerInfo;
        return $customerInfo->id;
        };
        return;
    }
    protected function isClosed($id){
        //Just a simple check to see if the submission is closed. 
        //It should be closed if the status is 3/Declined or the active status is set to 0.
        //Use this function to validate before any update/edit to a submission from either customer or admin.
        $closed = false;
        $submission = Submissions::select()->where('id', $id)->first();
        if($submission->active == 0 || $submission->status == 3){
            //Might have a second if statement to check if user is master.
            if($submission->status == 4 || Auth::User()->role == 2){
                return $closed;
            }
            $closed = true;
            abort(403, 'Submission is closed.');
        } 
        return $closed;
        
    }

        //Returns a new section for the created submission
        protected function receiptInfo($req, $container){
            if(!$this->isClosed($container->id)){
            $receiptSection = new ReceiptSections([
                'submission_id' => $container->id,
                'status' => 1,
                // 'vendor' => $vendor
            ]);
            $receiptSection->save();
         

            $getfolder = CustomerInfoSections::where('submission_id', $container->id)->first();

            $receiptfiles = FileUpload::where('folder', $getfolder->email)->where('size', 'new')->where('intake', 'receipt')->get();
    
            $oldfilePath = 'uploads/'. $getfolder->email . '/new/';
    
            $newfilePath = 'uploads/'. $getfolder->email . '/' . $container->id . '/';
    
            $s3 = Storage::disk('local');
            $receipts = Storage::disk('local')->allFiles($oldfilePath . 'receipt/');
    
            foreach($receipts as $receipt) {
                $new_loc = str_replace($oldfilePath . 'receipt/', $newfilePath . 'receipt/', $receipt);
                $s3->copy($receipt, $new_loc);
                $s3->delete($oldfilePath . 'receipt/', $receipt);
            }
            
            // // Storage::disk('local')->deleteDirectory($oldfilePath);
    
            foreach($receiptfiles as $file){
                $file->confirmid = $container->id; 
                $file->projectid = $container->id;
                $file->size = 'inuse';
                $file->userid = $container->customer_id;
                $file->save();      
            }



            return $receiptSection->id;
            }
            return;
        }


        protected function historyFullSubmission($submission, $message, $messagefr) {
        

            //***REMOVE THIS ONCE API AUTH IS ADDED
            if(Auth::user()){
                $user = Auth::user();
            } else{
                $user = User::select()->where('id', 5)->first();
            }
            // $user = User::select()->where('id', 3)->first();
            $check = HistoryStageSubmission::select()->where([
                ['author_id', '=', $user->id],
                ['customerinfo_section_id', '=', $submission->customerInfo->id],
                ['receipt_section_id', '=', $submission->receipts->id]
            ])->first();
                if($check !== null){
                    return;
                } else {
               
            $historySection = new HistoryStageSubmission([
                'author_id' => $user->id,
                'history_stages_submission_id' => $submission->history_stages_id,
                'customerinfo_section_id' => $submission->customerInfo->id,
                'receipt_section_id' => $submission->receipts->id,
                'message' => $message,
                'messagefr' => $messagefr
            ]);
            $historySection->save();
            return $historySection;
        }
        }

        public function deleteSubmission($id) {

            if(Auth::user()->id == 87) {
            $payment = PaymentSection::select()->where('submission_id', $id)->first();
            if($payment) {
                $payment->delete();
            }
            
            $submission = $this->getSubmissionData($id);
            $history = $submission->history_stages;
    
            if($submission) {
            $submission->delete();
            }
            if($history) {
            $history->delete();
            }
            $reasons = Reasons::select('id', 'reason')->delete();
            }
    
            return redirect('/submissions');
        }


        public function reviewSubmission(Request $request, $id){

            $submission = $this->getSubmissionData($id);
            $subid = $submission->id;
            $author = User::select()->where('id', $submission->customer_id)->first();
    
            $user = Auth::user();
            if(!$this->isClosed($id)){
    
                //Define the current sections attached to this submission
                $customerInfoSection = CustomerInfoSections::select()->where('id', $submission->customerinfo_section_id)->first();
                $receiptSection = ReceiptSections::select()->where('id', $submission->receipts_section_id)->first();
            
                //Update Customer Info Review
                $customerInfoSection->update([
                    'status' => $request->input('customerinfoStatus'),
                    'comments' => $request->input('customerinfoComment'),
                    'reason_id' => $request->input('customerinfoReason')
                ]);
    
            $customerInfoSection->save();
    
            //Update Receipt Info
            $receiptSection->update([
                'status' => $request->input('receiptStatus'),
                'comments' =>  $request->input('receiptComment'),
                'reason_id' => $request->input('receiptReason')
            ]);
            
            $receiptSection->save();
            $history = $this->historyFullSubmission($submission, "Reviewed submission", "Demande examinée");
    
            // return $history;
            //Compile all four sections' status. We will then check the array to see if all are approved or what statuses are prominent.
            $submissionStatusCheck = array($customerInfoSection->status, $receiptSection->status);
            $submissionStatus = $this->checkSubmissionSections($submissionStatusCheck);
    
            $duplicatepayment = PaymentSection::where('submission_id', $submission->id)->first();
            if(empty($duplicatepayment)){
    
            if($submissionStatus === 4){ 
                $makePayment = $this->makePaymentSection($submission, $request->purchasevalue,$request->purchasevalue);

                $user = User::where('id', $submission->customer_id)->first();
                $user->tiervalue = $user->tiervalue + $request->purchasevalue;
                $user->save();

                $subjectPay = "Submission Ready for Review";
                $mesPay = "A submission is ready for review.";
                Mail::to('ian@branton.ca')->send(new RebateUpdatePayment($subjectPay, $mesPay, $subid, 'Ian', "en"));
               // Mail::to('curtis@branton.ca')->send(new RebateUpdatePayment($subjectPay, $mesPay, $subid, 'Curtis', "en"));
            }
                $submission->update(['status'=>$submissionStatus]);
                $submission->save();
                $mes = "Your submission has been reviewed!";
                $subject = "Submission Reviewed";
    
    
                //We will need to push a language element into the submission to refer to...
                if(!$author->notifications == 1){
                    //Mail:: FOR TRAINUP
                 Mail::to($author)->send(new RebateUpdate($subject, $mes, $subid, $author, "en"));
                }
             }
         
                return redirect('/submissions/' . $submission->id);
            }
    
    
            return;
        }



        public function invoicevalue() {
            if(Auth::User()->role == 0){
                Auth::logout();
                return Redirect::to('https://asdtoolup.3mcanada.ca/');
            }
            // return Excel::download(new PaymentsForProcessing, 'asdtoolup-invoicevalues.xlsx');

            // return 'almost ready';

            $customers = User::with(['subs' => function ($q) { $q->with('payment_section'); }])->whereNotIn('id', [6, 87, 88,90,91,92,93,94,112])->get();

            foreach($customers as $user) {
                $total = 0;
                if($user->subs){
                foreach($user->subs as $sub) {
                    if($sub->payment_section){
                     $total = $total + $sub->payment_section->payment_amount_cad;
                    }
                }
            }
                $user->total = $total;
            }



        return view('exports.invoicevalue', ['customers' => $customers]);

        }



        public function getProducts(request $request){

            //I do not believe there is a french description for the products. 
            //The client API request will need to send in a token whether or not they want the French descriptions or English.
    
            // $limit = $request->input('limit');
            // $filter = $request->input('filter');
            // $category = $request->input('category');
            
            
            $returned_data = Rewards::with('reward_options')->get();
         
      
            return $returned_data;
        }


        public function getShipping($id){


            if(Auth::User()->role == 0){
                Auth::logout();
                return Redirect::to('https://asdtoolup.3mcanada.ca/');
                } 

    
            $certificate = Certificates::where('certid', $id)->with('author')->with('reward')->with('option')->orderBy('created_at', 'DESC')->first();

            // $certificate['issuedate'] = Carbon::parse($certificate->created_at)->translatedFormat('d M Y');
            // $certificate['expirydate'] = Carbon::parse($certificate->created_at)->addYear()->translatedFormat('d M Y');     
     
    
            // return $certificate;
    
            return view('shipping' ,['certificate' => $certificate]);
            

        }

        public function updateShipping($id, request $req){

         
        
            if(!$this->isCustomer()){
                $certificate = Certificates::where('certid', $id)->first();
    
                $certificate->shipped = $req->input('status');
                if($req->input('tracking') != null){
                $certificate->tracking = $req->input('tracking');
                               }
                $certificate->save();
              
                return redirect('/certificates');
            } else {
                abort(403); 
            }
        }

        public function generatePDF($certid){

            $certificate = Certificates::where('certid', $certid)->with('author')->first();

            // return view('pdf.certificate' ,['certificate' => $certificate]);    
            $pdf = PDF::loadView('pdf.certificate', ['certificate' => $certificate]);
            return $pdf->download($certificate->certid.'.pdf');
    
        }


        protected function checkRedeem(request $request){
            $country = 'ca';
            if(Auth::User()){
                $user = User::select()->where('id', Auth::id())->first();
            } else {
                return $request;
            }
    
            $totalrebate = 0;
            $rebatevalue = 0;
            $months = 0;
            $status = 1;
            $producttier = 0;
    
            $payments = Submissions::
            where('customer_id', $user->id)->
            whereHas('customerInfo', function($query) use ($country)  {$query->
                where('country', $country);})->
            whereHas('payment_state', function($query) use ($status){$query->where('id', $status); })->
            with('payment_section')->
            get();
                 
            foreach($payments as $purchase) {
            if(isset($purchase->payment_section->remainingvalue )){
            $totalrebate = intval($purchase->payment_section->remainingvalue) + intval($totalrebate);
            }
        } 
        
        
        
        switch (true) {
                case ($totalrebate < 2499) :
                    $months = 0;
                    $producttier = 0;
                    $returned_data = Rewards::where('redeemvalue', '<', '2499')->with('reward_options')->get();
                    break;
                case ($totalrebate < 2999) :
                    $producttier = 1;
                    $returned_data = Rewards::where('redeemvalue', '<', '2999')->with('reward_options')->get();
                    break;
                case ($totalrebate < 4999) :
                    $producttier = 2;
                    $returned_data = Rewards::where('redeemvalue', '<', '4999')->with('reward_options')->get();
                    break;
                case ($totalrebate < 6499) :
                        $producttier = 3;
                        $returned_data = Rewards::where('redeemvalue', '<', '6499')->with('reward_options')->get();
                        break;          
                case ($totalrebate < 9999) :
                        $producttier = 4;
                        $returned_data = Rewards::where('redeemvalue', '<', '9999')->with('reward_options')->get();
                        break;   
                default :
                    $producttier = 5;
                    $returned_data = Rewards::where('redeemvalue', '<', '1000000')->with('reward_options')->get();
                    break;         
                }

                // return $producttier;
            return $returned_data;
        }



        protected function checkSubmissionSections($arr){
            //This is given an array of all 4 sections' status. If all are equal to 4 (Approved), return 4.
            //Otherwise, if a single declined is in the submission, change submission status to declined.
    
            //1 - Pending
            //2 - Needs Info
            //3 - Declined
            //4 - Approved
    
            $status = 1; //Pending
                //This just checks the array to see if all are equal to 4
            if(count(array_keys($arr, 4)) == count($arr)){
                $status = 4; //Approved
            } 
            else if(in_array(3, $arr)){
                //This takes priority over Needs Info. 
                //If even one section is declined, then the whole submission is declined.
                $status = 3; // Declined
            }
            else if(in_array(2, $arr)){
                $status = 2; //Needs Info
            } 
            return $status;
        }

        protected function makePaymentSection($submission, $cad, $usd){
            $sid = $submission->id;
            if(!$this->isClosed($sid)){
            $paymentSection = new PaymentSection([
                "submission_id" => $sid,
              "payment_amount_cad" => $cad,
              "remainingvalue" => $usd
            ]);
            $paymentSection->save();
            return $paymentSection;
            };
            return;
        }

        protected function closeSubmission($id){
            //With active submissions, we still want them to be viewable 
            //but we want to remove any editing/updating functionality once closed.
            //This changes the submission's active status to 0.
            $submission = Submissions::select()->where('id', $id)->first();
            $submission->update([
                'active' => 0
            ]);
            $submission->save();
            return $submission;
        }

}