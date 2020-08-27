@extends('layouts.adminNav')

@section('content')
	<section id="addProduct">
		<div class="container">
			<div class="row">
				@include('admin.adminControls.sideBar')
				<div class="col-sm-9">
					<h1>Add Attachment
					<a href="/userprofile/{{ $user->id }}" class="btn btn-info float-right btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
					</h1>
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							@foreach ($errors as $error)
								{{ $error }}
							@endforeach
							@if($errors->has('file'))
								<li>{{ $errors->first('file') }}</li>
							@endif
							@if($errors->has('attachment-user'))
								<li>Please Select A User For Attachment Assignment</li>
							@endif
						</div>
					@endif
					<form action="/attachment" method="POST" enctype="multipart/form-data">
						@csrf
						
						<div class="border p-2">
							<h4>Upload attachment</h4>
							<input type="file" class="form-control" id="inputGroupFile01" required="required" accept="application/pdf" name="file" style="padding: 3px;">
							<small>Max Size: 3MB</small>
						</div>
						<p class="text-right">User ID: {{ $user->id }}</p>
						<input type="hidden" name="attachment-user" value="{{ $user->id }}">


						<button class="btn adminBtn text-white mt-2" type="submit">Assign attachment</button>


					</form>
				</div>
			</div>
		</div>
	</section>
@endsection