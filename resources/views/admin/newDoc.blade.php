@extends('layouts.adminNav')


@section('invoiceDeletion')
<script>
	
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
	
</script>
@endsection


@section('content')

	<section id="addProduct">
		<div class="container">
			<div class="row">
				@include('admin.adminControls.sideBar')
				<div class="col-sm-9">
					<h1>Add Document
					<a href="/userprofile/{{ $user->id }}" class="btn btn-info float-right btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
					</h1>
					
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							<li>Please upload a document</li>
						</div>
					@endif
					
					<form action="/uInv" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="border p-2 mb-3">
                            <h4>Document Name</h4>
                            <input type="text" class="form-control" name="fileName" required="required" style="padding: 3px;">
                        </div>
						<div class="border p-2">
							<h4>Upload ID & Document</h4>
							<input type="file" class="form-control" id="inputGroupFile01" required="required" accept="application/pdf" name="file" style="padding: 3px;">
							<small>Max Size: 3MB</small>
						</div>
						
						<p class="text-right">User ID : {{ $user->id }}</p>
                        <input type="hidden" name="the_user" value="{{ $user->id }}">

						<button class="btn adminBtn text-white mt-2" type="submit">Add Document</button>


					</form>
					
					<div class="list-group mt-5">
                            
                            @if($user->userInvoices->count() > 0)
                                
                                @foreach($user->userInvoices as $userInvoice)
                                <li class="list-group-item list-group-item-action">
                                    <a target='_blank' href='http://client.ksbin.com/storage/{{ $userInvoice->invoice }}'> 
                                    @if($userInvoice->name == "")
                                        ---
                                    @else 
                                        {{ $userInvoice->name }} 
                                    @endif
                                    </a>
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
	</section>
@endsection