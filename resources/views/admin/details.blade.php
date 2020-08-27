@extends('layouts.adminNav')
@section('userDeletion')
<script>
    function deleteDetails(id) {
		swal({
		title: "Remove Details?",
		text: "Are you sure you want to remove this detail?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		swal("Removing Details...", {
		icon: "success",
		});
		window.location = "/deleteDetails/"+id;
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
			<h1>All Policy Details Update Request</h1>
			
			@if (session('success'))
				<div class="alert alert-success">
		          {{ session('success') }}
		        </div>
		      @endif
			@if ($errors->any())
                <div class="alert alert-danger">
                    
                    <li>Please Type All The Required Credentials.</li>
                    
                </div>
            @endif
			<table id="all-users" class="display border p-2">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Subject</th>
						<th>Details</th>
						<th>Remove</th>
					</tr>
				</thead>
				<tbody>
				    <?php $x = 1; ?>
					@foreach($details as $detail)
                    
					<tr>
					    <td>{{ $x }}</td>
						<td class="text-capitalize">{{ $detail->user->name }}</td>
						<td>{{ $detail->user->email }}</td>
						<td class="text-capitalize">{{ $detail->subject }}</td>
						<td>
						<!-- Button trigger modal -->
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal{{$detail->id}}">
                          <i class="fas fa-eye"></i>
                        </button>
                        </td>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{$detail->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              
                                  
                              <div class="modal-body">
                                <p>
                                    <b>Subject: </b>
                                    {{ $detail->subject }}
                                </p>
                                <p>
                                    <b>Policy: </b>
                                    {{ $detail->policy }}
                                </p>
                                <p>
                                    <b>Subject: </b>
                                    {{ $detail->details }}
                                </p>
                              </div>
                             
                              
                            </div>
                          </div>
                        </div>
						<td>
							<button class="btn btn-danger" onclick="deleteDetails({{ $detail->id }})">
							    <i class="fas fa-trash-alt"></i>
							</button>
						</td>
					</tr>
					<?php $x++; ?>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection