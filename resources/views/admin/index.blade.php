@extends('layouts.adminNav')
@section('adminHomeCss')
	body {
    	background: #232931;
    }
@endsection
@section('content')

	<section id="mainPage">
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="dash-box dash-box-color-1">
						<div class="dash-box-icon">
							<i class="fas fa-user-circle"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count text-capitalize">{{ Auth::user()->name }}</span>
							<span class="dash-box-title">Your Profile</span>
						</div>
						
						<div class="dash-box-action">
							<a href="admin/{{ Auth::user()->id }}/edit">Edit Now</a>
						</div>				
					</div>
				</div>
				@if(Auth::user()->role_id == 3)
    				<div class="col-sm-3">
    					<div class="dash-box dash-box-color-5">
    						<div class="dash-box-icon">
    							<i class="fas fa-user-circle"></i>
    						</div>
    						<div class="dash-box-body">
    							<span class="dash-box-count text-capitalize">{{ $totalAdmins }}</span>
    							<span class="dash-box-title">All Admins</span>
    						</div>
    						
    						<div class="dash-box-action">
    							<a href="/viewAdmins">View All</a>
    						</div>				
    					</div>
    				</div>
    				<div class="col-sm-3">
    					<div class="dash-box dash-box-color-7">
    						<div class="dash-box-icon">
    							<i class="fas fa-user-circle"></i>
    						</div>
    						<div class="dash-box-body">
    							<span class="dash-box-count text-capitalize">{{ $totalNormalUsers }}</span>
    							<span class="dash-box-title">All Users</span>
    						</div>
    						
    						<div class="dash-box-action">
    							<a href="/viewUsers">View All</a>
    						</div>				
    					</div>
    				</div>
				@else
				    <div class="col-sm-6">
    					<div class="dash-box dash-box-color-5">
    						<div class="dash-box-icon">
    							<i class="fas fa-user-circle"></i>
    						</div>
    						<div class="dash-box-body">
    							<span class="dash-box-count text-capitalize">{{ $totalUsers }}</span>
    							<span class="dash-box-title">All Users</span>
    						</div>
    						
    						<div class="dash-box-action">
    							<a href="/viewUsers">View All</a>
    						</div>				
    					</div>
    				</div>
				@endif
				<div class="col-sm-4">
					<div class="dash-box dash-box-color-2">
						<div class="dash-box-icon">
							<i class="fas fa-copy"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count">{{ $totalInvoices }}</span>
							<span class="dash-box-title">Total Invoices</span>
						</div>
						
										
					</div>
				</div>
				<div class="col-sm-4">
					<div class="dash-box dash-box-color-3">
						<div class="dash-box-icon">
							<i class="fas fa-file-signature"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count">{{ $totalContracts }}</span>
							<span class="dash-box-title">Total Contracts</span>
						</div>
						
										
					</div>
				</div>
				<div class="col-sm-4">
					<div class="dash-box dash-box-color-4">
						<div class="dash-box-icon">
							<i class="fas fa-copy"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count">{{ $totalUserInvoices }}</span>
							<span class="dash-box-title">Invoices From Users</span>
						</div>
						
										
					</div>
				</div>
				<div class="col-sm-4 offset-sm-2">
					<div class="dash-box dash-box-color-5">
						<div class="dash-box-icon">
							<i class="fas fa-copy"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count">{{ $attachments }}</span>
							<span class="dash-box-title">Attachments From Users</span>
						</div>
						
								
					</div>
				</div>
				<div class="col-sm-4">
					<div class="dash-box dash-box-color-4">
						<div class="dash-box-icon">
							<i class="fas fa-copy"></i>
						</div>
						<div class="dash-box-body">
							<span class="dash-box-count">{{ $claims }}</span>
							<span class="dash-box-title">Claims</span>
						</div>
						
										
					</div>
				</div>
				
			</div>
		</div>
	</section>

@endsection