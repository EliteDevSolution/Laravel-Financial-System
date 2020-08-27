@extends('layouts.adminNav')

@section('pdf-js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="{{ asset('js/pdf.js') }}"></script>
<script src="{{ asset('js/pdf.worker.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/processing.js/1.4.1/processing-api.min.js"></script>
<script type="text/javascript" src="https://rawgithub.com/mozilla/pdf.js/gh-pages/build/pdf.js"></script>
@endsection

@section('content')

	<section id="addProduct">
		<div class="container">
			<div class="row">
				@include('admin.adminControls.sideBar')
				<div class="col-sm-9">
					<h1>Add Contract
					<a href="/userprofile/{{ $user->id }}" class="btn btn-info float-right btn-sm"><i class="fas fa-arrow-left"></i> Return</a>
					</h1>
					
					@if (session('message'))
						<div class="alert alert-success">
							{{ session('message') }}
						</div>
					@endif
					@if ($errors->any())
						<div class="alert alert-danger">
							@if($errors->has('contract-name'))
								<li>Contract Name Is Required</li>
							@endif
							@if($errors->has('file'))
								<li>{{ $errors->first('file') }}</li>
							@endif
							@if($errors->has('contract-user'))
								<li>Please Select A User For Contract Assignment</li>
							@endif
						</div>
					@endif
					
					<form action="/contract" method="POST" enctype="multipart/form-data">
						@csrf

						<div class="border p-2 mb-3">
							<h4>Contract Name</h4>
							<input type="text" class="form-control" required="required" name="contract-name" style="padding: 3px;" autocomplete="off">
						</div>
						
						<div class="border p-2">
							<h4>Upload Contract</h4>
							<input type="file" class="form-control" id="pdf" required="required" accept="application/pdf" name="file" style="padding: 3px;">
							<small>Max Size: 5MB</small>
						</div>
						
						<input type="hidden" id="show-image-data" name="pdfInImg">
						
						<!-- PDF To Image Code -->
						<canvas id="the-canvas" style="border:1px solid black; display:none"></canvas>
                          
                        
                          <!-- PDF.js -->
                          
                          
                          <script type="text/javascript">
                        
                            //
                            // Disable workers to avoid yet another cross-origin issue (workers need the URL of
                            // the script to be loaded, and dynamically loading a cross-origin script does
                            // not work)
                            //
                            PDFJS.disableWorker = true;
                        
                            //
                            // Asynchronous download PDF as an ArrayBuffer
                            //
                            var pdf = document.getElementById('pdf');
                            pdf.onchange = function(ev) {
                              if (file = document.getElementById('pdf').files[0]) {
                                fileReader = new FileReader();
                                fileReader.onload = function(ev) {
                                  console.log(ev);
                                  PDFJS.getDocument(fileReader.result).then(function getPdfHelloWorld(pdf) {
                                    //
                                    // Fetch the first page
                                    //
                                    console.log(pdf)
                                    pdf.getPage(1).then(function getPageHelloWorld(page) {
                                      var scale = 2;
                                      var viewport = page.getViewport(scale);
                        
                                      //
                                      // Prepare canvas using PDF page dimensions
                                      //
                                      var canvas = document.getElementById('the-canvas');
                                      var context = canvas.getContext('2d');
                                      canvas.height = viewport.height;
                                      canvas.width = viewport.width;
                        
                                      //
                                      // Render PDF page into canvas context
                                      //
                                      var task = page.render({canvasContext: context, viewport: viewport})
                                      task.promise.then(function(){
                                        console.log(canvas.toDataURL('image/jpeg'));
                                        document.getElementById('show-image-data').value = canvas.toDataURL('image/jpeg');
                                        
                                      });
                                    });
                                  }, function(error){
                                    console.log(error);
                                  });
                                };
                                fileReader.readAsArrayBuffer(file);
                              }
                            }
                          </script>
                          
                        
                        <style id="jsbin-css">
                        
                        </style>
                        <script>
                        
                        </script>
						
						
						<!--<div class="border p-2">-->
    		<!--				<div class="form-group">-->
      <!--                          <label for="exampleFormControlSelect1" style="font-size:18px;">Choose Contract</label>-->
      <!--                          <select class="form-control" id="exampleFormControlSelect1" name="file" required>-->
      <!--                              <option  disabled selected value>-- Select A Contract --</option>-->
      <!--                              <option value="firstContract">Voluntary Brocker Of Change</option>-->
      <!--                          </select>-->
      <!--                      </div>-->
      <!--                  </div>-->
						
						<p class="text-right">User ID : {{ $user->id }}</p>
                        <input type="hidden" name="contract-user" value="{{ $user->id }}">

						<button class="btn adminBtn text-white mt-2" type="submit">Assign Contract</button>


					</form>
				</div>
			</div>
		</div>
	</section>
@endsection