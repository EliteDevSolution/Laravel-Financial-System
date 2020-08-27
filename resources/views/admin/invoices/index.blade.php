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
			<h1>All Invoices</h1>
			
			<a href="/invoice/create" class="btn btn-info text-white mb-3">Add New Invoice</a>
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
						<th>Assigned To</th>
						<th>Paid</th>
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
							<button class="btn {{ $invoice->paid == '0' ? 'btn-outline-danger' : 'btn-outline-success' }}">
								{{ $invoice->paid == '1' ? '✓' : '⤫'  }}
							</button>
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
											<h6 class="text-capitalize"><b>Assigned To :</b> {{ $invoice->user->name }} </h6>
											<h6><b>User Email :</b> {{ $invoice->user->email }} </h6>
											<h6><b>Policy# :</b> {{ $invoice->user->policy_number }} </h6>
											<h6><b>Paid :</b> {{ $invoice->paid == '1' ? 'Yes' : 'No' }} </h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn btn-sm {{ $invoice->paid == 0 ? 'btn-success' : 'btn-danger' }}" onclick="invoicePaid({{ $invoice->id }})">{{ $invoice->paid == 0 ? 'Mark As Paid' : 'Mark As Unpaid' }}</button>
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