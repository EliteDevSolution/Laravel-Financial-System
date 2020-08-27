@extends('layouts.app')
@section('content')
@php
if (Auth::user()->role->name == "admin" || Auth::user()->role->name == "superadmin") {

    echo '<script>window.location = "/admin";</script>';

}

@endphp

@section('pdf-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{ asset('js/pdf.js') }}"></script>
<script src="{{ asset('js/pdf.worker.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/processing.js/1.4.1/processing-api.min.js"></script>
<script type="text/javascript" src="https://rawgithub.com/mozilla/pdf.js/gh-pages/build/pdf.js"></script>
@endsection

@section('theLoaderScript')
    <script>
        $('#loaderForm').submit(function() {

          $('#theLoader').removeClass('d-none');
        
        });
    </script>
@endsection

<style>
.nav-tabs .nav-link {
    text-transform: uppercase !important;
    border: 1px solid #dee2e6 !important;
    background: #f4f4f4;
}
footer{
    margin-top: 200px;
}
.dataTables_scrollHeadInner {
    width: 100% !important;
}
dataTables_scrollHead {
    width: 100% !important;
}
table {
    width: 100% !important;
}
.tab-content {
    background: #f9f9f9;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #2b599f;
    color: #fff !important;
    border-color: #2b599f;
    transition: 0.4s;
}
.the-loader {
    background: rgba(255,255,255,0.7);
    width: 100%;
    height: 100%;
    text-align: center;
    position: absolute;
    z-index: 999;
}
.the-spinner {
    position: absolute;
    top: 50%;
    margin-top: -0.8em;
}
.nav-tabs .nav-link {
    padding: 0.5rem 0.5rem !important;
}
</style>
<div class="the-loader d-none" id="theLoader">
    <div class="spinner-border text-primary the-spinner" role="status">
      <span class="sr-only">Loading...</span>
    </div>
</div>
<div id="profile-page" class="mb-5 pb-1">
    
    <div id="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    @if($user->user_image == "")
                        <img class="mt-4 img-thumbnail" style="width:150px;" src="{{ asset('storage/user-mail-icon.jpg') }}" >
                    @else
                        <img class="mt-4 img-thumbnail" style="width:150px;" src="{{ asset('storage/'. $user->user_image .'') }}">
                    @endif
                    <br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm mt-1" data-toggle="modal" data-target="#exampleModal">
                      Change Image
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Profile Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                          <div class="modal-body">
                            <form action="/userProfileImage/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        		                @csrf
        		                <input type="file" name="user_image" class="border" required> <br>
        		                <input type="submit" value="Upload" class="btn btn-primary mt-2">
        		            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h1 class="d-inline-block mt-5 text-capitalize main-heading">Welcome, <b>{{ Auth::user()->name }}</b> </h1> <br>
                    
                    <table class="bg-white table table-sm table-hover table-bordered mt-3 table-striped">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Policy#</th>
                          <th scope="col">From</th>
                          <th scope="col">To</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          @if(Auth::user()->policies->count())
                            @foreach(Auth::user()->policies as $pol)
                            <tr>
                              <th scope="row">{{ $i }}</th>
                              <td>{{ $pol->policy_number }}</td>
                              <td>{{ $pol->policy_from }}</td>
                              <td>{{ $pol->policy_to }}</td>
                              
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                          @else
                            <tr><td colspan="4" class="text-center">No Multiple Policies!</td></tr>
                          @endif
                      </tbody>
                    </table>
                    
                </div>
            </div>
            <div class="row main-screen mt-5">
                @if (session('message'))
                    <div class="alert alert-success w-100">
                        {{ session('message') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger w-100">
                        @if($errors->has('file'))at
                        <li>{{ $errors->first('file') }}</li>
                        @endif
                        @if($errors->has('paid'))
                        <li>{{ $errors->first('paid') }}</li>
                        @endif
                        @if($errors->has('invoice-user'))
                        <li>Please Select A User For Invoice</li>
                        @endif
                        @if($errors->has('subject'))
                        <li>Please Select A Subject</li>
                        @endif
                        @if($errors->has('policy'))
                        <li>Please Select A Policy</li>
                        @endif
                        @if($errors->has('details'))
                        <li>Please Write Some Details</li>
                        @endif
                    </div>
                @endif
                @if (session('renewalError'))
                    <div class="alert alert-danger w-100">
                        {{ session('renewalError') }}
                    </div>
                @endif
                <div class="col-md-12">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#contracts" role="tab" aria-controls="home" aria-selected="true">Signable Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#invoices" role="tab" aria-controls="profile" aria-selected="false">Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="user-uploads-tab" data-toggle="tab" href="#userUploads" role="tab" aria-controls="userUploads" aria-selected="false">ID Cards & Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="attachments-tab" data-toggle="tab" href="#attachments" role="tab" aria-controls="userUploads" aria-selected="false">Change My Policy Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="upload-tab" data-toggle="tab" href="#uploads" role="tab" aria-controls="profile" aria-selected="false">Upload Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="claim-tab" data-toggle="tab" href="#claim" role="tab" aria-controls="profile" aria-selected="false">File A Claim</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="renewal-tab" data-toggle="tab" href="#renewal" role="tab" aria-controls="renewal" aria-selected="false">Renewal 
                            @if($userRenewals->count() > 0)
                                <span class="badge badge-danger">{{ $userRenewals->count() }}</span>
                            @endif
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content border pl-3 pr-3" style="border-top: 1px solid transparent !important;" id="myTabContent">
                        {{-- CONTRACTS TAB --}}
                        <div class="tab-pane fade show active" id="contracts" role="tabpanel" aria-labelledby="home-tab">
                            <div class="user-details mt-5 mb-5">
                                <table id="user-contract" class="display p-2 cell-border hover">
                                    <thead>
                                        <tr>
                                            <th>Contract#</th>
                                            <th>Contract Name</th>
                                            <th>View/Download</th>
                                            <th>Status</th>
                                            <th>Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($contracts as $contract)
                                        <tr>
                                            <td>0{{ $contract->id }}</td>
                                            <td>{{ $contract->name }}</td>
                                            <td>
                                                <a href="{{ asset('storage/contracts/'.$contract->contract.'') }}" class="btn btn-outline-primary" target="_blank">
                                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                @if ($contract->signed == 0)
                                                <button class="btn btn-danger">⤫</button> <a href="{{route('signContract', $contract->id)}}" class="btn btn-info">Sign Now</a>
                                                @else
                                                <button class="btn disabled btn-success">
                                                Signed
                                                </button>
                                                @endif
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($contract->updated_at)) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- INVOICES TAB --}}
                        <div class="tab-pane fade" id="invoices" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="user-details mt-5 mb-5">
                                <table id="user-invoice" class="display p-2">
                                    <thead>
                                        <tr>
                                            <th>Invoice#</th>
                                            <th>Policy#</th>
                                            <th>Payment ($)</th>
                                            
                                            <th>Status</th>
                                            <th>Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($invoices as $invoice)
                                        
                                        <?php
                                            $id = base64_encode($invoice->id);
                                            $uid = base64_encode(Auth::user()->id);
                                            $nm = base64_encode(Auth::user()->name);
                                            $em = base64_encode(Auth::user()->email);
                                            $pr = base64_encode($invoice->price);
                                        ?>
                                        <tr>
                                            <td>0{{ $invoice->id }}</td>
                                            <td>
                                                @if ($invoice->policy == NULL)
                                                    Not Assigned
                                                @else
                                                    {{ $invoice->policy }}
                                                @endif
                                            </td>
                                            <td>{{ $invoice->price }}</td>
                                            
                                            <td>
                                                @if($invoice->paid == 0)
                                                    <button class="btn btn-danger }}">
                                                        ⤫
                                                    </button>
                                                    
                                                    
                                                    <a class="btn btn-info" href="http://epay.ksbin.com?uid={{ $uid }}&id={{ $id }}&nm={{ $nm }}&em={{ $em }}&pr={{ $pr }}" target="_blank">
                                                        Pay Now
                                                    </a>
                                                @else
                                                    <button class="btn btn-success">
                                                        Paid
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($invoice->updated_at)) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- UPLOADS TAB --}}
                        <div class="tab-pane fade p-3" id="uploads" role="tabpanel" aria-labelledby="upload-tab">
                            
                            
                            <form action="{{ route('userInvoice.store') }}" method="POST" class="mt-4 mb-4" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="border p-2 mb-3">
                                    <h4>Document Name</h4>
                                    <input type="text" class="form-control" name="fileName" required="required" style="padding: 3px;">
                                </div>
                                <div class="border p-2 mb-3">
                                    <h4>Upload Document</h4>
                                    
                                    <input type="file" class="form-control" id="inputGroupFile01" required="required" accept="application/pdf" name="file" style="padding: 3px;">
                                    <input type="hidden" value="{{ $user->id }}" name="the_user">
                                    <small>Max Size: 3MB</small>
                                </div>
                                <button class="btn btn-info text-white mt-2" type="submit">Upload Document <i class="fa fa-upload" aria-hidden="true"></i></button>
                            </form>
                        </div>
                        {{-- UPLOADED BY USER TAB --}}
                        <div class="tab-pane fade show" id="userUploads" role="tabpanel" aria-labelledby="user-uploads-tab">
                            <div class="user-details mt-5 mb-5">
                                <table id="user-uploads" class="display p-2">
                                    <thead>
                                        <tr>
                                            <th>Document#</th>
                                            <th>Document</th>
                                            <th>View/Download</th>
                                            <th>Updated</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userDocuments as $document)
                                        <tr>
                                            <td>0{{ $document->id }}</td>
                                            <td>
                                                @if($document->name == "")
                                                    ---
                                                @else 
                                                    {{ $document->name }} 
                                                @endif
                                                </td>
                                            
                                            <td>
                                                <a href="https://docs.google.com/viewerng/viewer?url={{ asset('storage/'.$document->invoice.'') }}&embedded=true" class="btn btn-outline-primary" type="application/pdf" target="_blank">
                                                    <i class="fa fa-external-link" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($document->updated_at)) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        {{-- ATTACHMENTS --}}
                        <div class="tab-pane fade show" id="attachments" role="tabpanel" aria-labelledby="attachments-tab">
                            <div class="user-details mt-5 mb-5">
                                @if($user->policies->count())
                                <form method="POST" action="/user/details/{{$user->id}}" class="container" id="loaderForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label for="subject">
                                                <b>Select A Subject</b>
                                            </label>
                                            <select class="custom-select" id="inputGroupSelect01" required="required" name="subject" required="required">
                                                <option disabled selected value> -- Select A Subject -- </option>
                                                <option value="Add/Remove Driver">Add/Remove Driver</option>
                                                <option value="Change Vehicle">Change Vehicle</option>
                                                <option value="Change Address">Change Address</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="policy">
                                                <b>Select A Policy</b>
                                            </label>
                                            <select class="custom-select" id="inputGroupSelect01" required="required" name="policy" required="required">
                                                <option disabled selected value> -- Select A Policy -- </option>
                                                @foreach($user->policies as $policy)
                                                <option value="{{ $policy->policy_number }}">{{ $policy->policy_number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <label for="policy">
                                                <b>Details</b>
                                            </label>
                                            <textarea class="form-control" name="details" rows="5" required="required"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="row mt-3 container">
                                        <button type="submit" class="btn btn-info">Send</button>
                                    </div>
                                </form>
                                @else
                                <p class="text-center" style="margin-bottom: 200px;"><b>You have not been assigned any policy yet!</b></p>
                                @endif
                            </div>
                        </div>
                        {{-- CLAIM A FILE TAB --}}
                        <div class="tab-pane fade p-3" id="claim" role="tabpanel" aria-labelledby="claim-tab">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ asset('storage/claim.pdf') }}" target="_blank" class="btn btn-info btn-sm">
                                            <i class="fa fa-download" aria-hidden="true"></i> Download The File
                                        </a>
                                        Download The File And Upload it back for further Claim..
                                        <!-- View Instructions -->
                                        <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#exampleModalInstructions">
                                          <i class="fa fa-eye" aria-hidden="true"></i> Instructions
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModalInstructions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Download & Fill The Form</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <li>Download & Open The File.</li>
                                                <li>You will see a two-page PDF. Carefully Read The Instructions.</li>
                                                <li>Page 1 is where you will fill-up your Data.</li>
                                                <li>
                                                    Click on any field to type in it.
                                                    <img src="{{ asset('img/type.png') }}" style="margin:0 auto;display:inherit;" class="border mb-3">
                                                </li>
                                                <li>
                                                    After typing all your data. Click on Print.
                                                    <img src="{{ asset('img/print.png') }}" style="margin:0 auto;display:inherit;" class="border mb-3">
                                                </li>
                                                <li>
                                                    Save the File As PDF & Set pages to all.
                                                    <img src="{{ asset('img/save.png') }}" style="margin:0 auto;display:inherit;" class="border mb-3">
                                                </li>
                                                <li>Your File will be saved. Upload it back here & click continue.</li>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <form action="{{ route('claim') }}" class="mt-4 mb-4" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="border p-2 mb-3">
                                                <h4>Upload Document</h4>
                                                <input type="file" class="form-control" id="pdf" required="required" accept="application/pdf" name="file" style="padding: 3px;">
                                                <input type="hidden" value="{{ $user->id }}" name="the_user">
                                                <input type="hidden" id="show-image-data" name="pdfInImg">
                                                <!-- PDF To Image Code -->
                        						<canvas id="the-canvas" style="border:1px solid black; display:none"></canvas>
                                                  
                                                
                                                  <!-- PDF.js -->
                                                  
                                                  
                                                  <script type="text/javascript">
                                                
                                                    //
                                                    // Disable workers to avoid yet another cross-origin issue (workers need the URL of
                                                    // the script to be loaded, and dynamically loading a cross-origin script does
                                                    // not work)
                                                    //
                                                    PDFJS.disableWorker = true;
                                                
                                                    //
                                                    // Asynchronous download PDF as an ArrayBuffer
                                                    //
                                                    var pdf = document.getElementById('pdf');
                                                    pdf.onchange = function(ev) {
                                                        document.getElementById("processing").style.display = "block";
                                                      if (file = document.getElementById('pdf').files[0]) {
                                                        fileReader = new FileReader();
                                                        fileReader.onload = function(ev) {
                                                          console.log(ev);
                                                          PDFJS.getDocument(fileReader.result).then(function getPdfHelloWorld(pdf) {
                                                            //
                                                            // Fetch the first page
                                                            //
                                                            console.log(pdf)
                                                            pdf.getPage(1).then(function getPageHelloWorld(page) {
                                                              var scale = 2;
                                                              var viewport = page.getViewport(scale);
                                                
                                                              //
                                                              // Prepare canvas using PDF page dimensions
                                                              //
                                                              var canvas = document.getElementById('the-canvas');
                                                              var context = canvas.getContext('2d');
                                                              canvas.height = viewport.height;
                                                              canvas.width = viewport.width;
                                                
                                                              //
                                                              // Render PDF page into canvas context
                                                              //
                                                              var task = page.render({canvasContext: context, viewport: viewport})
                                                              task.promise.then(function(){
                                                                console.log(canvas.toDataURL('image/jpeg'));
                                                                document.getElementById('show-image-data').value = canvas.toDataURL('image/jpeg');
                                                                document.getElementById("enable-me").classList.remove("disabled");
                                                                document.getElementById("enable-me").style.pointerEvents = "auto";
                                                                document.getElementById("processing").style.display = "none";
                                                              });
                                                            });
                                                          }, function(error){
                                                            console.log(error);
                                                          });
                                                        };
                                                        fileReader.readAsArrayBuffer(file);
                                                      }
                                                    }
                                                  </script>
                                                  
                                                
                                                <style id="jsbin-css">
                                                
                                                </style>
                                                <script>
                                                
                                                </script>
                                                <small>Max Size: 3MB</small>
                                            </div>
                                            <div id="processing" style="display:none;">Processing...</div>
                                            <button class="btn btn-info text-white mt-2 disabled" type="submit" id="enable-me" style="pointer-events: none;">Upload Filled Document <i class="fa fa-upload" aria-hidden="true"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- RENEWAL TAB --}}
                        <div class="tab-pane fade show p-3" id="renewal" role="tabpanel" aria-labelledby="renewal">
                            
                            @if($userRenewals->count() > 0)
                            
                            <table class="table table-bordered">
                              <thead class="thead-light">
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">DMV</th>
                                  <th scope="col">TLC</th>
                                  <th scope="col">DDC</th>
                                  <th scope="col">Price</th>
                                  <th scope="col">Pay Now</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @php 
                                    $rc = 1; 
                                  @endphp
                                  @foreach($userRenewals as $ren)
                                    <tr>
                                      <th scope="row">{{ $rc }}</th>
                                      <td>
                                          @if($ren->dmv == "") 
                                            ---
                                          @else
                                            <a href="/storage/{{ $ren->dmv }}" target="_blank">View</a>
                                          @endif
                                      </td>
                                      <td>
                                          @if($ren->tlc == "") 
                                            ---
                                          @else
                                            <a href="/storage/{{ $ren->tlc }}" target="_blank">View</a>
                                          @endif
                                      </td>
                                      <td>
                                          @if($ren->ddc == "") 
                                            ---
                                          @else
                                            <a href="/storage/{{ $ren->ddc }}" target="_blank">View</a>
                                          @endif
                                      </td>
                                      <td>{{ $ren->price }} $</td>
                                      <td>
                                          <?php
                                            $rid = base64_encode($ren->id);
                                            $ruid = base64_encode(Auth::user()->id);
                                            $rnm = base64_encode(Auth::user()->name);
                                            $rem = base64_encode(Auth::user()->email);
                                            $rpr = base64_encode($ren->price);
                                          ?>
                                          <a href="http://epay.ksbin.com/?ruid={{ $ruid }}&rid={{ $rid }}&rnm={{ $rnm }}&rem={{ $rem }}&rpr={{ $rpr }}" class="btn btn-info btn-sm">Pay Now</a>
                                      </td>
                                    </tr>
                                    @php 
                                        $rc++; 
                                      @endphp
                                  @endforeach
                              </tbody>
                            </table>
                            
                            @endif
                            
                            <form action="renewal/{{ $user->id }}" method="POST" class="mt-4 mb-4" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="border p-2 mb-3">
                                    <h4>Upload DMV license</h4>
                                    <input type="file" class="form-control" id="inputGroupFile01" accept="image/*" name="dmv" style="padding: 3px;">
                                    <small>Max Size: 3MB</small>
                                </div>
                                <div class="border p-2 mb-3">
                                    <h4>Upload TLC license</h4>
                                    <input type="file" class="form-control" id="inputGroupFile01" accept="image/*" name="tlc" style="padding: 3px;">
                                    <small>Max Size: 3MB</small>
                                </div>
                                <div class="border p-2 mb-3">
                                    <h4>Upload DDC Certificate</h4>
                                    <input type="file" class="form-control" id="inputGroupFile01" accept="image/*" name="ddc" style="padding: 3px;">
                                    <small>Max Size: 3MB</small>
                                </div>
                                
                                <button class="btn btn-info text-white mt-2" type="submit">Send <i class="fa fa-upload" aria-hidden="true"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
@endsection