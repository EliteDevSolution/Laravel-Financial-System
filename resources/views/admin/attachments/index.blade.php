@extends('layouts.adminNav')
@section('attachmentDeletion')
<script>
	
	function attachmentDeletion(id) {
		swal({
			title: "Delete Attachment?",
			text: "Are you sure you want to remove this attachment?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Removing Attachment...", {
					icon: "success",
				});
				window.location = "/deleteAttachment/"+id;
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
			<h1>All Attachments</h1>
			
			<a href="/attachment/create" class="btn btn-info text-white mb-3">Add New Attachment</a>
			@include('admin.errors')
			
			@if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
			@endif
			
			<table id="all-attachments" class="display border p-2">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>Assigned To</th>
						<th>Details</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($attachments as $attachment)
					<tr>
						<td>0{{ $attachment->id }}</td>
						<td>{{ $attachment->user->email }}</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#attachmentModal{{ $attachment->id }}">
								<i class="far fa-eye"></i>
							</button>
							{{-- DETAILS MODAL --}}
							<div class="modal fade" id="attachmentModal{{ $attachment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-capitalize font-weight-bold" id="exampleModalLabel">attachment#{{ $attachment->id }} - {{ $attachment->name }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h6 class="text-capitalize"><b>Assigned To :</b> {{ $attachment->user->name }} </h6>
											<h6><b>User Email :</b> {{ $attachment->user->email }} </h6>
											<h6><b>Policy# :</b> {{ $attachment->user->policy_number }} </h6>
											<h6><b>Attachment :</b> <a href="https://docs.google.com/viewerng/viewer?url={{ asset('storage/'.$attachment->attachment.'') }}&embedded=true" target="_blank">Attachment</a></h6>
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
							<button id="{{ $attachment->id }}" class="btn btn-danger" onclick="attachmentDeletion({{ $attachment->id }})"><i class="far fa-trash-alt"></i></button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>
@endsection