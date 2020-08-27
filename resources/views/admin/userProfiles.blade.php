@extends('layouts.adminNav')

@section('userProfileCss')
    .dash-box {
        border-radius: 15px !important;
        margin: 20px 0px !important;
    }
    .dash-box-body {
        padding: 20px 20px !important;
    }
@endsection

@section('invoiceDeletion')
<script>
	function invoiceDeletion(id) {	
		swal({
		  title: "Delete Invoice?",
		  text: "Are you sure you want to remove this Invoice?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Removing Invoice...", {
		      icon: "success",
		    });
		    window.location = "/user/deleteInvoice/"+id;
		  }
		});
	}
	
	function userInvoiceDeletion(id) {	
		swal({
		  title: "Delete Document?",
		  text: "Are you sure you want to remove this Document?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Removing Document...", {
		      icon: "success",
		    });
		    window.location = "/uInv/"+id;
		  }
		});
	}
	
	function invoicePaid(id) {	
		swal({
		  title: "Invoice Paid Status",
		  text: "Are you sure you want to change this Invoice Status?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, I am sure']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Invoice Status Changing...", {
		      icon: "success",
		    });
		    window.location = "/invoicePaid/"+id;
		  }
		});
	}
</script>
@endsection

@section('contractDeletion')
<script>
		function contractDeletion(id) {
		swal({
			title: "Delete Contract?",
			text: "Are you sure you want to remove this contract?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Contract Removing...", {
					icon: "success",
				});
				window.location = "/deleteContract/"+id;
			}
		});
	}
	function contractSigned(id) {	
		swal({
		  title: "Change Contract Status?",
		  text: "Are you sure you want to change this Contract Status?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, I am sure']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Contract Status Changing...", {
		      icon: "success",
		    });
		    window.location = "/contractSigned/"+id;
		  }
		});
	}
</script>

<script>
		function claimDeletion(id) {
    		swal({
    			title: "Delete Claim?",
    			text: "Are you sure you want to remove this claim?",
    			icon: "warning",
    			buttons: true,
    			dangerMode: true,
    			buttons: ['Cancel', 'Yes, Delete It']
    		})
    		.then((willDelete) => {
    			if (willDelete) {
    				swal("Claim Removing...", {
    					icon: "success",
    				});
    				window.location = "/deleteClaim/"+id;
    			}
    		});
    	}
    	function policyDeletion(id) {
    	    swal({
    			title: "Delete Policy?",
    			text: "Are you sure you want to remove this policy?",
    			icon: "warning",
    			buttons: true,
    			dangerMode: true,
    			buttons: ['Cancel', 'Yes, Delete It']
    		})
    		.then((willDelete) => {
    			if (willDelete) {
    				swal("Deleting Policy...", {
    					icon: "success",
    				});
    				window.location = "/deletePolicy/"+id;
    			}
    		});
    	}
</script>

@endsection



@section('content')
<div class="container">
	<div class="row">
		@include('admin.adminControls.sideBar')
		<div class="col-md-9">
		    @if (session('success'))
				<div class="alert alert-success">
		          {{ session('success') }}
		        </div>
		    @endif
		    @if (session('error'))
				<div class="alert alert-danger">
		          {{ session('error') }}
		        </div>
		    @endif
		    @if ($errors->any())
                <div class="alert alert-danger">
                    @if($errors->has('user_image'))
                        <li>Please Upload An Image.</li>
                    @endif
                    @if($errors->has('policy_number'))
                        <li>Please Add All Policy Details.</li>
                    @endif
                    @if($errors->has('policy_from'))
                        <li>Please Add All Policy Details.</li>
                    @endif
                    @if($errors->has('policy_to'))
                        <li>Please Add All Policy Details.</li>
                    @endif
                </div>
            @endif
		    <h1 class="text-capitalize">User ID : {{ $user->id }}</h1>
		    <div class="row">
		        
		        <div class="col-md-3 text-center">
		            @if($user->user_image == "")
		                <img src="/storage/user-mail-icon.jpg" style="width:100%" class="img-thumbnail"> 
		            @else
		                <img src="/storage/{{ $user->user_image }}" style="width:100%" class="img-thumbnail">
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
		            <p><b>Name : </b> <span class="text-capitalize">{{ $user->name }}</span> <br>
        			<b>Email : </b>{{ $user->email }} <br>
        			
        			<?php $i = 1; ?>
        			<table class="table table-sm table-hover table-bordered">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Policy#</th>
                          <th scope="col">From</th>
                          <th scope="col">To</th>
                          <th scope="col">Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                          @if($policy->count())
                            @foreach($policy as $pol)
                            <tr>
                              <th scope="row">{{ $i }}</th>
                              <td>{{ $pol->policy_number }}</td>
                              <td>
                                @php
                                    $newDateFrom = date("m-d-Y", strtotime($pol->policy_from));
                                @endphp
                                  {{ $newDateFrom }}
                              </td>
                              <td>
                                @php
                                    $newDateTo = date("m-d-Y", strtotime($pol->policy_to));
                                @endphp
                                {{ $newDateTo }}
                            </td>
                              <td class="text-center">
                                  <a href="#" onclick="policyDeletion({{ $pol->id }})">
                                      <i class="fa fa-trash text-danger"></i>
                                  </a>
                              </td>
                            </tr>
                            <?php $i++; ?>
                            @endforeach
                          @else
                            <tr><td colspan="5" class="text-center">No Multiple Policies!</td></tr>
                          @endif
                      </tbody>
                    </table>

        			
        			<!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal2">
                      Add New Policy
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Policy Details</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                          <div class="modal-body">
                            <form action="/userPolicyDetails/{{ $user->id }}" method="POST" enctype="multipart/form-data">
        		                @csrf
        		                Policy Number:
        		                <input type="text" name="policy_number" class="form-control mt-2" required>
        		                Policy From:
        		                <input type="date" name="policy_from" class="form-control mt-2" required>
        		                Policy To:
        		                <input type="date" name="policy_to" class="form-control mt-2" required> <br>
        		                <input type="submit" value="Add Policy Details" class="btn btn-primary mt-2">
        		            </form>
                          </div>
                          
                        </div>
                      </div>
                    </div>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModalPolicy">
                      Edit Policies
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalPolicy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg text-center" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Policies</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          
                          <div class="modal-body">
                              <?php $a = 1; ?>
                            @foreach($policy as $pol)
                            <form action="/userPolicyDetailsUpdate/{{ $pol->id }}" class="form-inline" method="POST" enctype="multipart/form-data">
        		                @csrf
        		                <div class="row">
        		                    <div class="col-sm-3">
        		                        <label for="policy_number" class="d-block text-left">Policy Number:</label>
        		                        <input type="text" name="policy_number" class="form-control" value="{{ $pol->policy_number }}" required>
        		                    </div>
        		                    <div class="col-sm-3">
        		                        <label for="policy_from" class="d-block text-left">Policy From:</label>
        		                        <input type="date" name="policy_from" class="form-control" value="{{ $pol->policy_from }}" required>
        		                    </div>
        		                    <div class="col-sm-3">
        		                        <label for="policy_to" class="d-block text-left">Policy To:</label>
        		                        <input type="date" name="policy_to" class="form-control" value="{{ $pol->policy_to }}" required>
        		                    </div>
        		                    <div class="col-sm-3">
        		                        <label for="policy_to" class="d-block text-left">
        		                            <span>&#8203;</span>
        		                        </label>
        		                        <input type="submit" value="Save Policy Details" class="btn btn-primary">
        		                    </div>
        		                </div>
        		                
        		                
        		                
        		                
        		            </form>
        		            <hr>
        		            <?php $a++; ?>
        		            @endforeach
                          </div>
                          
                        </div>
                      </div>
                    </div>
		        </div>
		        
		    </div>
			
			
			<div class="row border mt-3 mb-3">
			    <div class="col-sm-2 offset-sm-1">
    				<div class="dash-box dash-box-color-2 mt-4">
    					<div class="dash-box-body">
    						<span class="dash-box-count">{{ $user->invoices->count() }}</span>
    						<span class="dash-box-title">Payments</span>
    					</div>
    									
    				</div>
    			</div>
    			<div class="col-sm-2">
    				<div class="dash-box dash-box-color-3 mt-4">
    					<div class="dash-box-body">
    						<span class="dash-box-count">{{ $user->contracts->count() }}</span>
    						<span class="dash-box-title">Signable</span>
    					</div>
    									
    				</div>
    			</div>
    			<div class="col-sm-2">
    				<div class="dash-box dash-box-color-4 mt-4">
    					<div class="dash-box-body">
    						<span class="dash-box-count">{{ $user->attachments->count() }}</span>
    						<span class="dash-box-title">Requests</span>
    					</div>
    									
    				</div>
    			</div>
    			<div class="col-sm-2">
    				<div class="dash-box dash-box-color-5 mt-4">
    					<div class="dash-box-body">
    						<span class="dash-box-count">{{ $user->claims->count() }}</span>
    						<span class="dash-box-title">Claim</span>
    					</div>
    									
    				</div>
    			</div>
    			<div class="col-sm-2">
    				<div class="dash-box dash-box-color-6 mt-4">
    					<div class="dash-box-body">
    						<span class="dash-box-count">{{ $user->userInvoices->count() }}</span>
    						<span class="dash-box-title">ID & Docs</span>
    					</div>
    									
    				</div>
    			</div>
			</div>
			
			<div class="row">
			    
			    <div class="col-md-12">
    			    <div class="card w-100">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-left">
                        <button class="btn btn-dark text-white border-0" type="button" data-toggle="collapse" data-target="#upInvoices" aria-expanded="true" style="background: linear-gradient(to bottom, rgba(252, 190, 27, 1) 1%, rgba(248, 86, 72, 1) 99%);">
                            Payments <i class='fas fa-angle-down'></i>
                        </button>
                        <a class="text-success float-right p-0 pt-2" href="/invoice/create/{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Add New">
                            <i class="fas fa-plus"></i>
                        </a>
                        </h5>
                      </div>
                      
                      <div id="upInvoices" class="admin-menu collapse">
                        <div class="card-body px-4 py-2">
                          
                          
                          <div class="list-group">
                            
                            @if($user->invoices->count() > 0)
                                
                                @foreach($user->invoices as $userInvoice)
                                    <li class="list-group-item list-group-item-action">
                                        @if(!$userInvoice->due == NULL)
                                            <a target='_blank' href='https://docs.google.com/viewerng/viewer?url=http://client.ksbin.com/storage/{{ $userInvoice->invoice }}&embedded=true'> 
                                                @php
                                                    $newDateDue = date("m-d-Y", strtotime($userInvoice->due));
                                                @endphp
                                                Due Date : {{ $newDateDue }} 
                                            </a>
                                        @else
                                            <a target='_blank' href='https://docs.google.com/viewerng/viewer?url=http://client.ksbin.com/storage/{{ $userInvoice->invoice }}&embedded=true'> Payment {{ $userInvoice->id }} </a>
                                        @endif
                                        
                                        <button class="btn btn-danger ml-1 btn-sm float-right" onclick="invoiceDeletion({{ $userInvoice->id }})"><i class="far fa-trash-alt"></i></button>
                                        <button type="button" class="btn ml-1 btn-sm float-right {{ $userInvoice->paid == 0 ? 'btn-success' : 'btn-danger' }}"> {{ $userInvoice->paid == 0 ? 'Paid' : 'Unpaid' }}</button>
                                        
                                        <button type="button" class="btn btn-sm btn-warning float-right ml-1">{{ $userInvoice->price }} $</button>
                                    </li>
                                @endforeach
                                
                            @else
                                No Invoices Found!
                            @endif
                            
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
                
            
                <div class="col-md-12 mt-3">
                    <div class="card w-100">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-left">
                        <button class="btn btn-dark border-0 text-white" type="button" data-toggle="collapse" data-target="#upContracts" aria-expanded="true" style="background: linear-gradient(to bottom, rgba(183,71,247,1) 0%,rgba(108,83,220,1) 100%);">
                            Signable Documents <i class='fas fa-angle-down'></i>
                        </button>
                        <a class="text-success float-right p-0 pt-2" href="/contract/create/{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Add New">
                            <i class="fas fa-plus"></i>
                        </a>
                        </h5>
                      </div>
                      
                      <div id="upContracts" class="admin-menu collapse">
                        <div class="card-body px-4 py-2">
                          
                          
                          <div class="list-group">
                            
                            @if($user->contracts->count() > 0)
                            
                                @foreach($user->contracts as $userContract)
                                    <li class="list-group-item list-group-item-action">
                                        <a target='_blank' href='http://client.ksbin.com/storage/contracts/{{ $userContract->contract }}'> Document {{ $userContract->id }} </a>
                                        <button type="button" class="btn btn-sm ml-1 float-right {{ $userContract->signed == 0 ? 'btn-success' : 'btn-danger' }}"  onclick="contractSigned({{ $userContract->id }})">{{ $userContract->signed == 0 ? 'Mark As Signed' : 'Mark As Unsigned' }}</button>
                                        <button id="{{ $userContract->id }}" class="btn btn-danger btn-sm ml-1 float-right" onclick="contractDeletion({{ $userContract->id }})">
            							    <i class="far fa-trash-alt"></i>
            							</button>
            							@if($userContract->signed == '1')
            							    @php
            							        $encrypted = Crypt::encryptString($userContract->contract);
            							    @endphp
            							    <a class="btn btn-dark btn-sm float-right ml-1" href="/pdf/{{ $encrypted }}" target="_blank">
            							        <i class="fas fa-download text-white"></i>
            							    </a>
            							@endif
            						</li>
                                @endforeach
                                
                            @else
                                No Contracts Found!
                            @endif
                            
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>    
                </div>
		
			    
			    
            
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card w-100">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-left">
                        <button class="btn btn-dark border-0 text-white" type="button" data-toggle="collapse" data-target="#upclaims" aria-expanded="true" style="background: linear-gradient(to bottom, #a3f19a 0%,#8ad7a9 7%,#8ad79e 21%,#06ab42 100%);">
                            Claims <i class='fas fa-angle-down'></i>
                        </button>
                        </h5>
                      </div>
                      
                      <div id="upclaims" class="admin-menu collapse">
                        <div class="card-body px-4 py-2">
                          
                          
                          <div class="list-group">
                            
                            @if($user->claims->count() > 0)
                                
                                @foreach($user->claims as $userClaim)
                                <li class="list-group-item list-group-item-action">
                                    <a target='_blank' href='http://client.ksbin.com/storage/claims/{{ $userClaim->claim }}'> Claim {{ $userClaim->id }} </a>
                                    <button id="{{ $userClaim->id }}" class="btn btn-danger btn-sm float-right ml-1" onclick="claimDeletion({{ $userClaim->id }})">
        							    <i class="far fa-trash-alt"></i>
        							</button>
        							@if($userClaim->signed == '1')
        							    @php
        							        $encrypted = Crypt::encryptString($userClaim->claim);
        							    @endphp
        							    <a class="btn btn-dark btn-sm float-right ml-1" href="/downloadClaim/{{ $encrypted }}" target="_blank">
        							        <i class="fas fa-download text-white"></i>
        							    </a>
        							@endif
                                </li>
                                    
                                @endforeach
                                
                            @else
                                No Claims Found!
                            @endif
                            
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card w-100">
                      <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-left">
                        <button class="btn btn-dark border-0 text-white" type="button" data-toggle="collapse" data-target="#upDocs" aria-expanded="true" style="background: linear-gradient(to bottom, rgba(255, 86, 65, 1) 0%, rgba(253, 50, 97, 1) 100%);">
                            ID Cards & Documents <i class='fas fa-angle-down'></i>
                        </button>
                        <a class="text-success float-right p-0 pt-2" href="/document/create/{{ $user->id }}" data-toggle="tooltip" data-placement="top" title="Add New">
                            <i class="fas fa-plus"></i>
                        </a>
                        </h5>
                      </div>
                      
                      <div id="upDocs" class="admin-menu collapse">
                        <div class="card-body px-4 py-2">
                          
                          
                          <div class="list-group">
                            
                            @if($user->userInvoices->count() > 0)
                                
                                @foreach($user->userInvoices as $userInvoice)
                                <li class="list-group-item list-group-item-action">
                                    <a target='_blank' href='http://client.ksbin.com/storage/{{ $userInvoice->invoice }}'> Document {{ $userInvoice->id }} </a>
                                    <button id="{{ $userInvoice->id }}" class="btn btn-danger btn-sm float-right" onclick="userInvoiceDeletion({{ $userInvoice->id }})">
        							    <i class="far fa-trash-alt"></i>
        							</button>
                                </li>
                                    
                                @endforeach
                                
                            @else
                                No Documents Found!
                            @endif
                            
                            
                          </div>
                          
                        </div>
                      </div>
                    </div>
                </div>
			    
			</div>
			
			
			
		</div>
	</div>
</div>
@endsection