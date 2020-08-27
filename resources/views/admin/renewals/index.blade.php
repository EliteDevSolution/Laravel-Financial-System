@extends('layouts.adminNav')
@section('invoiceDeletion')
<script>
	function invoiceDeletion(id) {	
		swal({
		  title: "Delete Request?",
		  text: "Are you sure you want to remove this Request?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Removing Request...", {
		      icon: "success",
		    });
		    window.location = "/deleteRenewal/"+id;
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
@section('content')
<div class="container">
	<div class="row">
		@include('admin.adminControls.sideBar')
		<div class="col-md-9">
			<h1>Renewal Reuqests</h1>
			
			@include('admin.errors')
			
			@if (session('message'))
				<div class="alert alert-success">
					{{ session('message') }}
				</div>
			@endif
			
			<table id="all-contracts" class="display border p-2">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>Name</th>
						<th>Email</th>
						<th>Price($)</th>
						<th>Status</th>
						<th>Details</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>
				    @foreach($renewals as $renewal)
					<tr>
						<td>0{{ $renewal->id }}</td>
						<td class="text-capitalize">{{ $renewal->user->name }}</td>
						<td>{{ $renewal->user->email }}</td>
						<td>
						    @if($renewal->price == NULL)
						        Not Set
						    @else
						        {{ $renewal->price }}
						    @endif
						</td>
						<td>
						    @if($renewal->status == NULL)
						        <button class="btn btn-secondary btn-sm">Pending</button>
						    @elseif($renewal->status == 0)
						        <button class="btn btn-danger btn-sm">Unpaid</button>
						    @elseif($renewal->status == 1)
						        <button class="btn btn-success btn-sm">Paid</button>
						    @endif
						</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#contractModal{{ $renewal->id }}">
								<i class="far fa-eye"></i>
							</button>
							{{-- DETAILS MODAL --}}
							<div class="modal fade" id="contractModal{{ $renewal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-capitalize font-weight-bold" id="exampleModalLabel">Renewal Details # 0{{ $renewal->id }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h6 class="text-capitalize"><b>User Name :</b> {{ $renewal->user->name }} </h6>
											<h6><b>User Email :</b> {{ $renewal->user->email }} </h6>
											<h6><b>DMV :</b> @if($renewal->dmv == "") --- @else <a href="/storage/{{ $renewal->dmv }}" download>Download</a> @endif </h6>
											<h6><b>TLC :</b> @if($renewal->tlc == "") --- @else <a href="/storage/{{ $renewal->tlc }}" download>Download</a> @endif </h6>
											<h6><b>DDC :</b> @if($renewal->ddc == "") --- @else<a href="/storage/{{ $renewal->ddc }}" download>Download</a> @endif </h6>
											
											@if($renewal->price == NULL)
											
											    <h6><b>Price :</b> Not Set </h6>
											    <hr>
											    <form method="POST" action="/renewalPrice/{{ $renewal->user->id }}/{{ $renewal->id }}">
											        @csrf
											        <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Renewal Amount ($)</span>
                                                      </div>
                                                      <input type="number" name="renewal-price" class="form-control" required="required" step="0.01" placeholder="Please input the amount">
                                                    </div>
                                                    
                                                    <input type="submit" value="Set Price" class="btn btn-info mt-2">
                                                      
											    </form>
											    
											@else
											
											    <h6><b>Price :</b> {{ $renewal->price }} $</h6>
											    <hr>
											    <form method="POST" action="/renewalPrice/{{ $renewal->user->id }}/{{ $renewal->id }}">
											        @csrf
											        <div class="input-group">
                                                      <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1">Update Amount ($)</span>
                                                      </div>
                                                      <input type="number" name="renewal-price" class="form-control" required="required" step="0.01" placeholder="Please input the amount">
                                                    </div>
                                                    
                                                    <input type="submit" value="Update Price" class="btn btn-info mt-2">
                                                      
											    </form>
											    
											@endif
											
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							{{-- DETAILS MODAL END --}}
						</td>
						<td>
							<button class="btn btn-danger" onclick="invoiceDeletion({{ $renewal->id }})"><i class="far fa-trash-alt"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			
		</div>
	</div>
</div>
@endsection