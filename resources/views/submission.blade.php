@extends('layouts.app')
@section('title', 'Customer Submission #'.$submission->id   )
@section('content')

<section class="container">
    <div class="content">
    <!-- {{-- <p>You are viewing this Submission as: {{$user}}</p> --}} -->
    <div>
        <p class="mainStatus statusText-{{$submission->submission_status->id}}">{{$submission->submission_status->status}}</p>
    </div>
    <div>
        
        <h1>Submission — # {{$submission->id}}</h1>
        <br>
        @if($submission->status == 4)
            @if($payid !== "none")
            <p><a href="{{url('payments/'.$payid)}}">View Payment</a> ({{$submission->payment_state->status}})</p>
            @endif
       
        @endif
    </div>

    <div>
    <br>
    <br>
@if (Auth::user()->id == 87)
<a href="../submissions/admin/delete/{{ $submission->id }}" class="small-submit-button" role="button">Remove</a>
@endif
    </div>
    
    {{-- <p>{{$submission->updated_at}}</p>
    <p>Active: {{$submission->active}}</p>
    <p>Created by: {{$submission->author->fname}} ({{$submission->author->email}})</p>
    <p>Payment Status: {{$submission->payment_state->status}}</p> --}}
    
    @if($user === "Admin") 
    <form class="displayFlex" method="POST" action="{{ url('submission-review') }}/{{ $submission->id }}">
    @csrf
    @endif



    <!--====    Customer Info   ====-->

    <div class="section-row">
    <div class="section-rebate dropShadow margin displayFlex"> 
        <div data-section-head="customer" data-status="status-{{$submission->customerInfo->status_state->id}}" class="statusBar "></div>
        <div class="submissionHeadings displayFlex">
            <h2>Customer Info <span class="smallStatus">({{$submission->customerInfo->status_state->status}})</h2>
            <div class="header-side">
            @if($user === "Customer")
                @if($submission->submission_status->id != 3 && $submission->active != 0 && $submission->submission_status->id != 4)
                    @if($submission->customerInfo->status_state->status === 'Pending' || $submission->customerInfo->status_state->status === 'Need Info')
                    <a href="{{ url('edit-info/customer-info/') }}/{{ $submission->id }}">Edit</a>
                    @endif
                @endif
                <img src="{{asset("images/icons/".strtolower($submission->customerInfo->status_state->id)."-status-icon.svg")}}"class='review-submission-section-icon' data-image-status='Customer Info section is {{$submission->customerInfo->status_state->status}}'>
            @else
                <div class="updateStatus">
                <button data-target='customer'><svg class="approved @if($submission->customerInfo->status_state->status === 'Approved') active @endif" xmlns="http://www.w3.org/2000/svg" width="25.853" height="22.961" viewBox="0 0 25.853 22.961">
                            <g class="checkmark-for-verification">
                                <path  class="Path_366" data-name="Path 366" d="M25.672,8.611,22.237,5.592a.529.529,0,0,0-.747.048L9.031,19.822,4.6,13.958a.528.528,0,0,0-.349-.2.522.522,0,0,0-.392.1L.21,16.612a.53.53,0,0,0-.1.742L8.31,28.21a.53.53,0,0,0,.4.21h.019a.529.529,0,0,0,.4-.18L25.72,9.359A.529.529,0,0,0,25.672,8.611Z" transform="translate(0 -5.46)" />
                            </g>
                        </svg></button>
                        <button data-target='customer'><svg class="need-info @if($submission->customerInfo->status_state->status === 'Need Info') active @endif" xmlns="http://www.w3.org/2000/svg" width="17.087" height="23.668" viewBox="0 0 17.087 23.668">
                        <g class="question-sign">
                            <g class="Group_52" data-name="Group 52" transform="translate(0 0)">
                            <path class="Path_364" data-name="Path 364" d="M138.23,274.074h-4.438a.759.759,0,0,0-.74.74v4.438a.758.758,0,0,0,.74.74h4.438a.759.759,0,0,0,.74-.74v-4.438a.76.76,0,0,0-.74-.74Z" transform="translate(-127.726 -256.323)"/>
                            <path class="Path_365" data-name="Path 365" d="M67.133,4.466a7.666,7.666,0,0,0-1.96-2.358,10.024,10.024,0,0,0-2.7-1.535A8.288,8.288,0,0,0,59.5,0a9.445,9.445,0,0,0-8.58,4.919.73.73,0,0,0-.1.518A.719.719,0,0,0,51.1,5.9L54.134,8.21a.886.886,0,0,0,.462.148.719.719,0,0,0,.573-.3,12.613,12.613,0,0,1,1.978-2.126,3.5,3.5,0,0,1,2-.536,3.423,3.423,0,0,1,1.988.591,1.671,1.671,0,0,1,.86,1.368,2.076,2.076,0,0,1-.462,1.405A4.56,4.56,0,0,1,59.977,9.8a7.809,7.809,0,0,0-2.644,2.006,4.308,4.308,0,0,0-1.2,2.894v.832a1.388,1.388,0,0,0,.194.694.556.556,0,0,0,.472.342h4.438a.644.644,0,0,0,.518-.287.967.967,0,0,0,.222-.6,2.519,2.519,0,0,1,.508-1.239,3.625,3.625,0,0,1,1.267-1.2q.721-.407,1.128-.656a9.366,9.366,0,0,0,1.064-.8,5.318,5.318,0,0,0,1.017-1.1A6.244,6.244,0,0,0,67.891,7.4,6.058,6.058,0,0,0,67.133,4.466Z" transform="translate(-50.804 0)"/>
                            </g>
                        </g>
                        </svg></button>
                        <button data-target='customer'><svg class="declined @if($submission->customerInfo->status_state->status === 'Declined') active @endif" xmlns="http://www.w3.org/2000/svg" width="21.602" height="21.602" viewBox="0 0 21.602 21.602">
                            <path class="forbidden-mark" d="M18.167.13a.446.446,0,0,0-.629,0L11.116,6.552a.446.446,0,0,1-.629,0L4.064.13a.446.446,0,0,0-.629,0l-3.3,3.3a.446.446,0,0,0,0,.629l6.422,6.422a.446.446,0,0,1,0,.629L.13,17.538a.446.446,0,0,0,0,.629l3.3,3.3a.446.446,0,0,0,.629,0l6.422-6.422a.446.446,0,0,1,.629,0l6.422,6.422a.446.446,0,0,0,.629,0l3.3-3.3a.446.446,0,0,0,0-.629L15.05,11.116a.446.446,0,0,1,0-.629l6.422-6.422a.446.446,0,0,0,0-.629Z"/>
                        </svg></button>
                </div>

            @endif
            </div>
            @if($user !== "Customer")
            <div class="submitReview" data-name="customer-review" id='customerInfo'>   
            <div class="review-sections">
                    <div class='section-comments'>
                        <label for="customerinfoComment">Comments</label>
                        <textarea name="customerinfoComment" placeholder='Your comments (Optional)' ></textarea>
                    </div>
                    <div class="section-dropdowns">
                    <div class='section-status'>
                        <label for="customerinfoStatus">Section Status</label>
                        <select name="customerinfoStatus" id="customerinfoStatus">
                            @foreach ($statuses as $status)
                            <option @if ($status->status == $submission->customerInfo->status_state->status) {{ 'selected' }} @endif value="{{$status->id}}" >{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class='section-reason'>
                        <label for="customerinfoReason">Reason</label>
                        <select name="customerinfoReason" id="customerinfoReason">
                            @foreach ($reasons as $reason)
                            <option value="{{$reason->id}}">{{$reason->reason}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                        </div>
                </div>
                </div>
                @endif
        </div>
        <div>
            <div class="flex-row">
                <div class="flex-row-item">
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Full Name</strong></p>
                        <p class="p50">{{$submission->customerInfo->fname}} {{$submission->customerInfo->lname}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Phone Number</strong></p>
                        <p class="p50">{{$submission->customerInfo->phone}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Email Address</strong></p>
                        <p class="p50">{{$submission->customerInfo->email}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Company</strong></p>
                        <p class="p50">{{$submission->customerInfo->company}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Country</strong></p>
                        @if($submission->customerInfo->country === 'us')
                        <p class="p50">United States</p>
                        @elseif($submission->customerInfo->country === 'ca')
                        <p class="p50">Canada</p>
                        @else
                        <p class="p50">N/A</p>
                        @endif
                    </div>
                </div>

                <div class="flex-row-item">
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Address</strong></p>
                        <p class="p50">{{$submission->customerInfo->address}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>City</strong></p>
                        <p class="p50">{{$submission->customerInfo->city}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Postal</strong></p>
                        <p class="p50">{{$submission->customerInfo->postal}}</p>
                    </div>
                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Profession</strong></p>
                        <p class="p50">{{$submission->customerInfo->profession}}</p>
                    </div>

                    <div class="displayFlex padding borderGray">
                        <p class="p50"><strong>Channel Partner Name (Optional)</strong></p>
                        <p class="p50">{{$submission->customerInfo->channel}}</p>
                    </div>
                  
                </div>
</div>
            
        </div>
    </div>
        </div>


<div class="section-row flex-row">
    <div class="section-rebate dropShadow margin flex-row-item ">
        <div data-section-head="receipt" data-status="status-{{$submission->receipts->status_state->id}}" class="statusBar"></div>
        <div class="submissionHeadings displayFlex">
            <h2>Receipts Review <span class="smallStatus">({{$submission->receipts->status_state->status}})</h2>
            <div class="header-side">
            @if($user === "Customer")   
            @if($submission->submission_status->id != 3 && $submission->active != 0 && $submission->submission_status->id != 4)
                @if ($submission->receipts->status_state->status === 'Pending' || $submission->receipts->status_state->status === 'Need Info')
                <a href="{{ url('edit-info/receipt-info/') }}/{{ $submission->id }}">Edit</a>
                @endif
                @endif
                <img src="{{asset("images/icons/".strtolower($submission->receipts->status_state->id)."-status-icon.svg")}}"class='review-submission-section-icon' data-image-status='Receipt section is {{$submission->receipts->status_state->status}}'>
            @else
            <div class="updateStatus">
                        <button data-target='receipt'><svg class="approved @if($submission->receipts->status_state->status === 'Approved') active @endif" xmlns="http://www.w3.org/2000/svg" width="25.853" height="22.961" viewBox="0 0 25.853 22.961">
                            <g class="checkmark-for-verification">
                                <path  class="Path_366" data-name="Path 366" d="M25.672,8.611,22.237,5.592a.529.529,0,0,0-.747.048L9.031,19.822,4.6,13.958a.528.528,0,0,0-.349-.2.522.522,0,0,0-.392.1L.21,16.612a.53.53,0,0,0-.1.742L8.31,28.21a.53.53,0,0,0,.4.21h.019a.529.529,0,0,0,.4-.18L25.72,9.359A.529.529,0,0,0,25.672,8.611Z" transform="translate(0 -5.46)" />
                            </g>
                        </svg></button>
                        <button data-target='receipt'><svg class="need-info @if($submission->receipts->status_state->status === 'Need Info') active @endif" xmlns="http://www.w3.org/2000/svg" width="17.087" height="23.668" viewBox="0 0 17.087 23.668">
                        <g class="question-sign">
                            <g class="Group_52" data-name="Group 52" transform="translate(0 0)">
                            <path class="Path_364" data-name="Path 364" d="M138.23,274.074h-4.438a.759.759,0,0,0-.74.74v4.438a.758.758,0,0,0,.74.74h4.438a.759.759,0,0,0,.74-.74v-4.438a.76.76,0,0,0-.74-.74Z" transform="translate(-127.726 -256.323)"/>
                            <path class="Path_365" data-name="Path 365" d="M67.133,4.466a7.666,7.666,0,0,0-1.96-2.358,10.024,10.024,0,0,0-2.7-1.535A8.288,8.288,0,0,0,59.5,0a9.445,9.445,0,0,0-8.58,4.919.73.73,0,0,0-.1.518A.719.719,0,0,0,51.1,5.9L54.134,8.21a.886.886,0,0,0,.462.148.719.719,0,0,0,.573-.3,12.613,12.613,0,0,1,1.978-2.126,3.5,3.5,0,0,1,2-.536,3.423,3.423,0,0,1,1.988.591,1.671,1.671,0,0,1,.86,1.368,2.076,2.076,0,0,1-.462,1.405A4.56,4.56,0,0,1,59.977,9.8a7.809,7.809,0,0,0-2.644,2.006,4.308,4.308,0,0,0-1.2,2.894v.832a1.388,1.388,0,0,0,.194.694.556.556,0,0,0,.472.342h4.438a.644.644,0,0,0,.518-.287.967.967,0,0,0,.222-.6,2.519,2.519,0,0,1,.508-1.239,3.625,3.625,0,0,1,1.267-1.2q.721-.407,1.128-.656a9.366,9.366,0,0,0,1.064-.8,5.318,5.318,0,0,0,1.017-1.1A6.244,6.244,0,0,0,67.891,7.4,6.058,6.058,0,0,0,67.133,4.466Z" transform="translate(-50.804 0)"/>
                            </g>
                        </g>
                        </svg></button>
                        <button data-target='receipt'><svg class="declined @if($submission->receipts->status_state->status === 'Declined') active @endif" xmlns="http://www.w3.org/2000/svg" width="21.602" height="21.602" viewBox="0 0 21.602 21.602">
                            <path class="forbidden-mark" d="M18.167.13a.446.446,0,0,0-.629,0L11.116,6.552a.446.446,0,0,1-.629,0L4.064.13a.446.446,0,0,0-.629,0l-3.3,3.3a.446.446,0,0,0,0,.629l6.422,6.422a.446.446,0,0,1,0,.629L.13,17.538a.446.446,0,0,0,0,.629l3.3,3.3a.446.446,0,0,0,.629,0l6.422-6.422a.446.446,0,0,1,.629,0l6.422,6.422a.446.446,0,0,0,.629,0l3.3-3.3a.446.446,0,0,0,0-.629L15.05,11.116a.446.446,0,0,1,0-.629l6.422-6.422a.446.446,0,0,0,0-.629Z"/>
                        </svg></button>
                </div>

            @endif
            
</div>


@if($user !== "Customer")  
<div class="submitReview padding" data-name='receipt-review'> 
<div class="review-sections">
                    {{-- <div class='section-comments'>
                        <label for="receiptComment">Comments</label>
                        <textarea name="receiptComment" placeholder='Your comments (Optional)' ></textarea>
                    </div> --}}
                    <div class="section-dropdowns">
                    <div class='section-status'>
                        <label for="receiptStatus">Section Status</label>
                        <select name="receiptStatus" id="receiptStatus">
                            @foreach ($statuses as $status)
                            <option @if ($status->status == $submission->receipts->status_state->status) {{ 'selected' }} @endif value="{{$status->id}}" >{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div>
                        <label for="receiptReason">Reason</label>
                        <select name="receiptReason" id="receiptReason">
                            @foreach ($reasons as $reason)
                            <option value="{{$reason->id}}" >{{$reason->reason}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                        </div>
            </div>
                        </div>
            @endif
        </div>
        <div class="padding">

             <div class="displayFlex" id="tradeinGall">


                @if(isset($submission->receipts->receiptsuploaded[0]->photo))
                @if($submission->receipts->receiptsuploaded[0]->kind === 'pdf')
                <a href='{{ asset("/uploads/".$submission->receipts->receiptsuploaded[0]->photo) }}'><img class="receiptGallJumbo" src='{{ asset('images/icons/pdficon.png') }}' /></a>                
                @else
              <img class="receiptGallJumbo" src='{{ asset("/uploads/lrg-".$submission->receipts->receiptsuploaded[0]->photo) }}'/>   
                @endif
                @endif


                <div class="receiptrow">
                @foreach ($submission->receipts->receiptsuploaded as $receipt)
                @if($receipt->kind === 'pdf')
  
                <a href='{{ asset("/uploads/".$receipt->photo) }}' class="openpdf">Click to open PDF</a> 
                <a href='{{ asset("/uploads/".$receipt->photo) }}'><img id="{{$receipt->photo}}" src='{{ asset('images/icons/pdficon.png') }}' /></a>    
                @else
                <img id="{{$receipt->photo}}" src='{{ asset("/uploads/".$receipt->photo) }}'/>                       
                @endif
                @endforeach
                </div>
                
            </div>



                            <table class="table table-borderless table-striped">
                        <thead>
                            <tr class="file-head">
                                <th class="min-width-150">File Name</th>
                                <th class="min-width-80">Type</th>
                                <th class="min-width-80">Size</th>
                                <th class="min-width-80">Options</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse($receipts as $file)
                            <tr>
                                <td class="align-middle">{{ $file->name }}</td>
                                <td class="align-middle">{{ $file->kind }}</td>
                                
                                <td class="align-middle">{{ $file->rawsize }}</td>
                                <td class="align-middle">
                                    <a href="../uploads/{{ $file->folder }}/{{ $file->projectid }}/{{ $file->intake }}/{{ $file->name }}"><i class="fa fa-download"></i> Open</a> 
                                 
                                </td>

                            </tr>

                            @empty
                            <tr>
                                <td colspan="7"><em>No files available.</em></td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
            
        </div>
    </div>

</div>



    <div style="margin-bottom:50px;" id="showcomment" class="section-rebate dropShadow margin flex-row-item ">
        <div class="submissionHeadings displayFlex">
   
@if($user !== "Customer")  
<div class="review-sections">
                    <div class='section-comments'>
                        <label for="customerinfoComment">Comments (if required when a submission is declined or needs more info. The end user will see this message.)</label>
                        <br><br>
                        <textarea style="width: 100%; height: 129px;"name="customerinfoComment" placeholder='Your comments (Optional)' ></textarea>
                    </div>
                  
            </div>
                   
            @endif
        </div>
    </div>




<div class="section-rebate history-section margin">
    <h2 class="historyHeadings">History</h2>
    <div class="table-list">
            <div class="table-headers">
                <ul class='four-col'>
                    <li><h4>User</h4></li>
                    <li><h4>Description</h4></li>
                    <li><h4>Date</h4></li>
                    <li><h4>Comments</h4></li>
                </ul>  
            </div>
        @foreach ($history->history_stages_submission as $his)
        <div class="table-row">     
        <div class="table-row-head single-row">
            <h3>History Submission</h3>
        </div>  
        <ul class="four-col">
            <li>
                <div class='single-row item-title'>
                    <h5>User:</h5>
                </div>
                <div class="item-content">
                    <p>{{$his->author->fname}} {{$his->author->lname}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Description:</h5>
                </div>
                <div class="item-content">
                    <p>{{$his->message}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Date:</h5>
                </div>
                <div class="item-content">
                    <p>{{$his->updated_at->format('Y-m-d')}}</p>
                </div>
            </li>
            <li>
                <div class='single-row item-title'>
                    <h5>Comments:</h5>
                </div>
                <div class="item-content">
                @if($his->author->role !== 0)
                <p><a data-target='{{$his->id}}'href='#'>View Comments</a></p>
                <div data-comments='{{$his->id}}'class="comment-lightbox">
                   
                    <div class="comment-content dropShadow">
                        <div class="submission-comment-head">
                    <h2>Submission #{{$submission->id}} – Reviewed {{$his->updated_at->format('Y-m-d')}}
                    </h2>
                    <button class='close-comment'>Close</button>
                    </div>
                        <ul>
                            <li>
                                <div class="header status-{{$his->customerinfo_section->status_state->id}}">
                                <h2 >Customer Info – {{$his->customerinfo_section->status_state->status}}</h2>
                                </div>
                            </li>

                            <li>
                                <div class="header status-{{$his->receipt_section->status_state->id}}">
                                <h2>Receipts Uploaded – {{$his->receipt_section->status_state->status}}</h2>
                                </div>
                    
                            </li>

                            <li>
                                <div class="review-comment-content">
                                    <p class='review-comment'>@if($his->customerinfo_section->comments){{$his->customerinfo_section->comments}} @else No comments. @endif</p>
                
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                @else
                <p class='no-comments'>None</p>
                @endif
                </div>
            </li>
        </ul>
        </div>
        @endforeach
    </div>
</div>




    @if($user === "Admin") 
    <div class="send-off-review">
        <hr>
        <div class="double-check">
            <h2>Review Rebate</h2>
            <ul>
                <li data-section-review="customer">
                    <div class='image-container'>
                        <img src="{{asset("images/icons/".strtolower($his->customerInfo_section->status_state->id)."-status-icon.svg")}}"class='review-submission-section-icon' data-image-status='Customer Info section is {{$his->customerInfo_section->status_state->status}}'>
                    </div> 
                    <p>Customer Info</p>                  
                </li>
                <li data-section-review="receipt">
                    <div class='image-container'>
                        <img src="{{asset("images/icons/".strtolower($his->receipt_section->status_state->id)."-status-icon.svg")}}"class='review-submission-section-icon' data-image-status='Receipt section is {{$his->receipt_section->status_state->status}}'>
                    </div> 
                    <p>Receipts Uploaded</p>                  
                </li>

                @if(empty($payment->payment_amount_cad))
                <label for="purchasevalue">Purchase Value</label><br>
                <input required class="purchasevalue" type="number" step="any" placeholder="Purchase Value" value='' name='purchasevalue'>
                @endif

                @if(isset($payment->payment_amount_cad))
                <li>
                    <div class='image-container'>
                        <img src="{{asset("images/icons/".strtolower($his->receipt_section->status_state->id)."-status-icon.svg")}}"class='review-submission-section-icon' data-image-status='${{$payment->payment_amount_cadus}}'>
                    </div> 
                    <p>${{ $payment->payment_amount_cad }}</p>                  
                </li>
                @endif
            </ul>

        </div>
    </div>
    @endif
    @if($user === "Admin") 
    <input type="submit" @if($submission->status == 4) disabled @endif class='submit-button' value="Review Submission">
    </form>
    @endif
    </div>
</section>

@endsection