@extends('layouts.adminNav')
@section('userDeletion')
<script>
	function deleteUser(id) {
		swal({
		title: "Delete User and Their Data?",
		text: "Are you sure you want to remove this admin?",
		icon: "warning",
		buttons: true,
		dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
		swal("Removing Admin...", {
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
			<!-- Button trigger modal -->
            <button type="button" class="btn btn-info mb-3" data-toggle="modal" data-target="#exampleModal">
              Add Admin
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add A New Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form method="post" action="/addAdmin">
                    @csrf
                      
                  <div class="modal-body">
                    <input type="text" class="form-control mb-2" name="name" placeholder="Username" required>  
                    <input type="email" class="form-control mb-2" name="email" placeholder="Email" required>  
                    <input type="password" class="form-control mb-2" name="password" placeholder="Password" required>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Add Admin</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>
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
						<th>ID</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Remove User</th>
					</tr>
				</thead>
				<tbody>
				    <?php $x = 1; ?>
					@foreach($users as $user)
                    
					<tr>
					    <td>{{ $x }}</td>
						<td>{{ $user->name }}</td>
						<td>{{ $user->email }}</td>
						<td>
							<button class="btn btn-danger" onclick="deleteUser({{ $user->id }})"><i class="far fa-trash-alt"></i></button>
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