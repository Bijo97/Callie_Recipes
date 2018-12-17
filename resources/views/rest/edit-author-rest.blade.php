@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<h1 class="text-uppercase">Edit Profile</h1>
				<p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
			</div>
		</div>
	</div>
</div>
<!-- /PAGE HEADER -->
@endsection

@section('content')
	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="section-row">
						<div class="section-title">
							<h2 class="title">Edit your profile</h2>
						</div>
					<form method="POST" action="../update-author/{{ $res->id }}">
                    <input type="hidden" name="id_author" id="id_author" value="{{ $res->id }}" />
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="name" id="name" value="{{ $res->name }}" placeholder="Your name">
									</div>
								</div>
								
                                <div class="col-md-12">
									<div class="form-group">
										<input class="input" type="email" name="email" id="email" value="{{ $res->email }}" placeholder="Your email">
									</div>
								</div>
								<div class="col-md-12">
										Select image to upload:
										<input type="file" name="imagefile" id="imagefile"><br/>
									</div>
								</div>
								<button type="submit" class="primary-button">Update</button>
                            </div>
                            <div class="row">
                                
                            </div>
						</form>
					</div>
				</div>
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	@endsection

	@section('js')
	<script>
		  function updateprofile(){
			// var markupStr =$(".summernote").summernote("code");
			var name = $('#name').val();
            var email = $('#email').val();
			var token = $('#_token').val();
            var id_author = $('#id_author').val();
			var file = document.getElementById('imagefile').files[0];
			var formData = new FormData();
			formData.append('image_user', file);
			formData.append('name', name);
			formData.append('email', email);
			formData.append('_token', token);
			// window.location.href = "insert-post";
			$.ajax({
				type: 'POST',
				url: '../update-author/' + id_author,
				data: formData,
				processData: false,
				contentType: false,	
				success: function(result){
					alert("Edit Profile Success!");
					window.location.href = "/author";
				} 
			});

			// $.ajax({
			// 	type: 'POST',
			// 	url: 'insert-post',
			// 	data: formData,
			// 	processData: false,
			// 	contentType: false,
			// 	success: function(result){
			// 		if (result == "good"){
			// 			alert("Create Post Success!");
			// 			window.location.href = "/author";
			// 		} else {
			// 			alert("Create Post Fail!");
			// 		}
			// 	}
			// });


		  }
	</script>
	@endsection
