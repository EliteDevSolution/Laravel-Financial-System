@extends('layouts.adminNav')
@section('contractPrinting')
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>
<script src="{{ asset('js/html2canvas.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
<script src="{{ asset('js/fileSaver.js') }}"></script>
<script>
    function printTheContract(theContract) {
        // var doc = new jsPDF();
        // var elementHTML = $('#download-contract').html();
        // var specialElementHandlers = {
        //     '#elementH': function(element, renderer) {
        //         return true;
        //     }
        // };
        
        var canvas = document.createElement("canvas");
        context = canvas.getContext('2d');
        
        make_base();
        
        function make_base()
        {
          base_image = new Image();
          base_image.src = '/storage/contracts/'+theContract+'';
          
          base_image.onload = function(){
            context.drawImage(base_image, 100, 100);
          }
        } 
        var thisImg = 'http://client.ksbin.com/storage/contracts/'+theContract+'';
        console.log(thisImg);
        var jpegUrl = canvas.toDataURL(thisImg);
        var pngUrl = canvas.toDataURL(thisImg);
        
        console.log(jpegUrl);
        console.log(pngUrl);

        // doc.fromHTML(elementHTML, 1, 1, {
        //     'width': 170,
        //     'elementHandlers': specialElementHandlers
        // });
        // doc.save('sample-document.pdf');
    }
</script>
@endsection
@section('contractDeletion')
<script>
		function contractDeletion(id) {
		swal({
			title: "Delete Claim?",
			text: "Are you sure you want to remove this claim?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Claim Removing...", {
					icon: "success",
				});
				window.location = "/deleteClaim/"+id;
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
			<h1>All Claims</h1>
			
			@include('admin.errors')
			
			@if (session('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
			@endif
			
			<table id="all-claims" class="display border p-2">
				<thead>
					<tr>
						<th>Sr#</th>
						<th>Assigned To</th>
						<th>Download</th>
						<th>Details</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($claims as $claim)
					<tr>
						<td>0{{ $claim->id }}</td>
						<td>{{ $claim->user->email }}</td>
						<td>
							@if($claim->signed == '1')
							    @php
							        $encrypted = Crypt::encryptString($claim->claim);
							    @endphp
							    <a class="btn btn-dark" href="/downloadClaim/{{ $encrypted }}" target="_blank">
							        <i class="fas fa-download text-white"></i>
							    </a>
							    <div id="download-contract" style="display:none">
							        <h1>asdsada asd</h1>
							        <img width="100%" src="{{ asset('storage/claims/'.$claim->claim.'') }}" >
							    </div>
							    <div id="elementH"></div>
							@endif
						</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#contractModal{{ $claim->id }}">
								<i class="far fa-eye"></i>
							</button>
							{{-- DETAILS MODAL --}}
							<div class="modal fade" id="contractModal{{ $claim->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-capitalize font-weight-bold" id="exampleModalLabel">Claim#{{ $claim->id }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h6 class="text-capitalize"><b>Assigned To :</b> {{ $claim->user->name }} </h6>
											<h6><b>User Email :</b> {{ $claim->user->email }} </h6>
											<h6><b>Policy# :</b> {{ $claim->user->policy_number }} </h6>
											<h6><b>Claim Signed :</b> {{ $claim->signed == '1' ? 'Yes' : 'No' }} </h6>
											<h6><b>Claim File :</b> <a href="{{ asset('storage/claims/'.$claim->claim.'') }}" target="_blank">Claim File</a></h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
							{{-- DETAILS MODAL END --}}
						</td>
						<td class="pl-4">
							<button id="{{ $claim->id }}" class="btn btn-danger" onclick="contractDeletion({{ $claim->id }})">
							    <i class="far fa-trash-alt"></i>
							</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			
		</div>
	</div>
</div>

@endsection