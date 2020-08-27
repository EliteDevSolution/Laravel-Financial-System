@extends('layouts.adminNav')
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
		    window.location = "/deleteInvoice/"+id;
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
			<h1>Documents From Users</h1>
			
			<table id="invoices-by-users" class="display border p-2">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>Assigned To</th>
						<th>Invoice</th>
						<th>Details</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($invoices as $invoice)
					<tr>
						<td>0{{ $invoice->id }}</td>
						<td>{{ $invoice->user->email }}</td>
						<td>
							<a href="https://docs.google.com/viewerng/viewer?url={{ asset('storage/'.$invoice->invoice.'') }}&embedded=true" target="_blank" class="btn btn-info">
							    <i class="fas fa-external-link-alt"></i>
							</a>
						</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#contractModal{{ $invoice->id }}">
								<i class="far fa-eye"></i>
							</button>
							{{-- DETAILS MODAL --}}
							<div class="modal fade" id="contractModal{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-capitalize font-weight-bold" id="exampleModalLabel">Invoice # 0{{ $invoice->id }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h6 class="text-capitalize"><b>Uploaded By :</b> {{ $invoice->user->name }} </h6>
											<h6><b>User Email :</b> {{ $invoice->user->email }} </h6>
											<h6><b>Policy# :</b>
												@if ($invoice->user->policy_number == 0)
												 	Not Assigned
												@else
													{{ $invoice->user->policy_number }} 
												@endif 
											</h6>
											<h6><b>Upload Time:</b> {{ $invoice->updated_at }}</h6>
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
							<button class="btn btn-danger" onclick="invoiceDeletion({{ $invoice->id }})"><i class="far fa-trash-alt"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			
		</div>
	</div>
</div>
@endsection