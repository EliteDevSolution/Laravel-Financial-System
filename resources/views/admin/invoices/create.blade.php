@extends('layouts.adminNav')

@section('content')
	<section id="addProduct">
		<div class="container">
			<div class="row">
				@include('admin.adminControls.sideBar')
				<div class="col-sm-9">
					<h1>Add Invoice
					<a href="/userprofile/{{ $user->id }}" class="btn btn-info float-right btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
					</h1>
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							@if($errors->has('file'))
								<li>Please Select A File</li>
							@endif
							@if($errors->has('paid'))
								<li>Please Select If The Invoice is Paid or Not</li>
							@endif
							@if($errors->has('invoice-user'))
								<li>Please Select A User For Invoice</li>
							@endif
							@if($errors->has('invoice-price'))
								<li>Please Enter An Amount For The Invoice</li>
							@endif
							@if($errors->has('policy'))
								<li>Please Select A Policy</li>
							@endif
							@if($errors->has('due'))
								<li>Please Add A Due Date</li>
							@endif
						</div>
					@endif
					<form action="/invoice" method="POST" enctype="multipart/form-data">
						@csrf
						
						<!--<div class="border p-2">-->
						<!--	<h4>Upload Invoice</h4>-->
						<!--	<input type="file" class="form-control" id="inputGroupFile01" required="required" accept="application/pdf" name="file" style="padding: 3px;">-->
						<!--	<small>Max Size: 3MB</small>-->
						<!--</div>-->
						 
						
						
						<div class="mt-3">
    						<div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">Invoice Amount ($)</span>
                              </div>
                              <input type="number" name="invoice-price" class="form-control" required="required" step="0.01" placeholder="Please input the amount">
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Policy</label>
                              </div>
                              <select class="custom-select" id="inputGroupSelect01" required="required" name="policy">
                                <option disabled selected value> -- Select A Policy -- </option>
                                @foreach($user->policies as $policy)
                                <option value="{{ $policy->policy_number }}">{{ $policy->policy_number }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>
                        
                        <div class="mt-3">
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Due Date</label>
                              </div>
                              <input type="date" name="due" class="form-control" required>
                            </div>
                        </div>
                        
						
						
						<p class="text-right">User ID : {{ $user->id }}</p>
						<input type="hidden" name="invoice-user" value="{{ $user->id }}">

						<button class="btn adminBtn text-white" type="submit">Add Invoice</button>


					</form>
				</div>
			</div>
		</div>
	</section>
@endsection