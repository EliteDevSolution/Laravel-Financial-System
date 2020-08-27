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
			title: "Delete Contract?",
			text: "Are you sure you want to remove this contract?",
			icon: "warning",
			buttons: true,
			dangerMode: true,
			buttons: ['Cancel', 'Yes, Delete It']
		})
		.then((willDelete) => {
			if (willDelete) {
				swal("Contract Removing...", {
					icon: "success",
				});
				window.location = "/deleteContract/"+id;
			}
		});
	}
	function contractSigned(id) {	
		swal({
		  title: "Change Contract Status?",
		  text: "Are you sure you want to change this Contract Status?",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		  buttons: ['Cancel', 'Yes, I am sure']
		})
		.then((willDelete) => {
		  if (willDelete) {
		    swal("Contract Status Changing...", {
		      icon: "success",
		    });
		    window.location = "/contractSigned/"+id;
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
			<h1>All Contracts</h1>
			
			<a href="/contract/create" class="btn btn-info text-white mb-3">Add New Contract</a>
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
						<th>Signed</th>
						<th>Details</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($contracts as $contract)
					<tr>
						<td>0{{ $contract->id }}</td>
						<td>{{ $contract->user->email }}</td>
						<td>
							<button class="btn {{ $contract->signed == '0' ? 'btn-danger' : 'btn-success' }}">
								{{ $contract->signed == '1' ? '✓' : '⤫'  }}
							</button>
							@if($contract->signed == '1')
							    @php
							        $encrypted = Crypt::encryptString($contract->contract);
							    @endphp
							    <a class="btn btn-dark" href="/pdf/{{ $encrypted }}" target="_blank">
							        <i class="fas fa-download text-white"></i>
							    </a>
							    <div id="download-contract" style="display:none">
							        <h1>asdsada asd</h1>
							        <img width="100%" src="{{ asset('storage/contracts/'.$contract->contract.'') }}" >
							    </div>
							    <div id="elementH"></div>
							@endif
						</td>
						<td>
							<button type="button" class="btn btn-info" data-toggle="modal" data-target="#contractModal{{ $contract->id }}">
								<i class="far fa-eye"></i>
							</button>
							{{-- DETAILS MODAL --}}
							<div class="modal fade" id="contractModal{{ $contract->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title text-capitalize font-weight-bold" id="exampleModalLabel">Contract#{{ $contract->id }} - {{ $contract->name }}</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<h6 class="text-capitalize"><b>Assigned To :</b> {{ $contract->user->name }} </h6>
											<h6><b>User Email :</b> {{ $contract->user->email }} </h6>
											<h6><b>Policy# :</b> {{ $contract->user->policy_number }} </h6>
											<h6><b>Contract Signed :</b> {{ $contract->signed == '1' ? 'Yes' : 'No' }} </h6>
											<h6><b>Contract :</b> <a href="{{ asset('storage/contracts/'.$contract->contract.'') }}" target="_blank">{{ $contract->name }}</a></h6>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="button" class="btn {{ $contract->signed == 0 ? 'btn-success' : 'btn-danger' }}"  onclick="contractSigned({{ $contract->id }})">{{ $contract->signed == 0 ? 'Mark As Signed' : 'Mark As Unsigned' }}</button>
										</div>
									</div>
								</div>
							</div>
							{{-- DETAILS MODAL END --}}
						</td>
						<td class="pl-4">
							<button id="{{ $contract->id }}" class="btn btn-danger" onclick="contractDeletion({{ $contract->id }})">
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