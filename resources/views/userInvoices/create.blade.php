@extends('layouts.app')
@section('content')
@php
if (Auth::user()->role->name == "admin") {
echo '<script>window.location = "/admin";</script>';
}
@endphp
<style>
	footer {
		position: absolute;
		bottom: 0px;
		width: 100%;
	}
</style>
<div id="create-invoice-page" class="mb-5 pb-1">
    
    <div id="create-invoice">
        <div class="container">
            <div class="row text-center">
                <h1 class="d-inline-block mt-5 text-capitalize main-heading">Add Invoice</h1>
            </div>
            <div class="row main-screen mt-5">
            	<div class="col-md-6 offset-md-3 mt-3">
            		
            	
            	@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							@if($errors->has('file'))
								<li>{{ $errors->first('file') }}</li>
							@endif
							@if($errors->has('paid'))
								<li>{{ $errors->first('paid') }}</li>
							@endif
							@if($errors->has('invoice-user'))
								<li>Please Select A User For Invoice</li>
							@endif
						</div>
					@endif
					<form action="{{ route('userInvoice.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						
						<div class="border p-2">
							<h4>Upload Invoice</h4>
							<input type="file" class="form-control" id="inputGroupFile01" required="required" accept="application/pdf" name="file" style="padding: 3px;">
							<input type="hidden" value="{{ $user->id }}" name="the_user">
							<small>Max Size: 3MB</small>
						</div>

						<button class="btn btn-info text-white mt-2" type="submit">Add Invoice</button>


					</form>
            	</div>
            </div>
        </div>
    </div>
    
</div>
@endsection
