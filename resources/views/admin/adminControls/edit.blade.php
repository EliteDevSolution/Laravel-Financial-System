@extends('layouts.adminNav')

@section('content')
	<div id="editForm">
	<div class="container">
	<div class="row">
		
		@include('admin.adminControls.sideBar')

		<div class="col-md-9">
			
			@if (session('message'))
				<div class="alert alert-success">
          {{ session('message') }}
        </div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif
		    <div class="card">
		        <div class="card-body">
		            <div class="row">
		                <div class="col-md-12">
		                    <h4>Your Profile</h4>
		                    <hr>
		                </div>
		            </div>
		            <div class="row">
		                <div class="col-md-12">
		                    <form method="POST" action="/admin/{{ Auth::user()->id }}">
          								@csrf
          								@method('PATCH')
                              <div class="form-group row">
                                <label for="adminName" class="col-4 col-form-label">Admin Name*</label> 
                                <div class="col-8">
                                  <input id="adminName" name="adminName" class="form-control here" type="text" value="{{ Auth::user()->name }}">
                                </div>
                              </div>
                             
                              <div class="form-group row">
                                <label for="adminEmail" class="col-4 col-form-label">Email*</label> 
                                <div class="col-8">
                                  <input id="adminEmail" name="adminEmail" class="form-control here" type="text" value="{{ Auth::user()->email }}">
                                </div>
                              </div>

                              <div class="form-group row">
                                <label for="adminPass" class="col-4 col-form-label">Old Password</label> 
                                <div class="col-8">
                                  <input id="adminPass" name="adminPass" placeholder="Old Password" class="form-control here" type="Password">
                                </div>
                              </div> 

                              <div class="form-group row">
                                <label for="newPass" class="col-4 col-form-label">New Password</label> 
                                <div class="col-8">
                                  <input id="newPass" name="newPass" placeholder="New Password" class="form-control here" type="Password">
                                </div>
                              </div> 
                              <div class="form-group row">
                                <div class="offset-4 col-8">
                                  <button name="submit" type="submit" class="btn btn-primary adminBtn">Update My Profile</button>
                                </div>
                              </div>
                            </form>
		                </div>
		            </div>
		            
		        </div>
		    </div>
		</div>
	</div>
</div>
	</div>
@endsection