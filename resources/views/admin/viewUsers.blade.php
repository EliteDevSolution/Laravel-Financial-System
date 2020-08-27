@extends('layouts.adminNav')
@section('userDeletion')
<script>
	function deleteUser(id) {
		swal({
		title: "Delete User and Their Data?",
		text: "Are you sure you want to delete this user and their data (Invoices and Contracts)",
		icon: "warning",
		buttons: true,
		dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		swal("Deleting User and Its Data...", {
		icon: "success",
		});
		window.location = "/deleteUser/"+id;
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
			<h1>All Users</h1>
			@if (session('success'))
				<div class="alert alert-success">
		          {{ session('success') }}
		        </div>
		      @endif
			@if ($errors->any())
                <div class="alert alert-danger">
                    @if($errors->has('policy_number'))
                        <li>Please Write A Policy Number</li>
                    @endif
                </div>
            @endif
			<table id="all-users" class="display border p-2">
				<thead>
					<tr>
						<th>User Name</th>
						<th>Email</th>
						<th>Policy Number(s)</th>
						<th>Profile</th>
						<th>Remove User</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $user)
                    @if ($user->role_id == 1 || $user->role_id == 3)
                    
                    @else
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
						    @if($user->policies->count())
						        <select class="form-control p-0" id="exampleFormControlSelect1" style="width: auto">
                                    @foreach($user->policies as $pol)
                                    
                                      <option>{{ $pol->policy_number }}</option>
                                    
                                    @endforeach
                                </select>
                            @else
                                No Policy Assigned!
                            @endif
						</td>
						<td>
						    @if ($user->role_id == 1)
						    ---
							@else
    							<a href="/userprofile/{{ $user->id }}" target="_blank" class="btn btn-info">
    							    <i class="fas fa-external-link-alt"></i>
    							</a>
							@endif
						</td>
						
						<td>
							@if ($user->role_id == 1)
								---
							@else
								<button class="btn btn-danger" onclick="deleteUser({{ $user->id }})"><i class="far fa-trash-alt"></i></button>
							@endif
						</td>
					</tr>
					@endif
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection