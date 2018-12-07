@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<h1 class="text-uppercase">Edit Posts</h1>
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
							<h2 class="title">Edit Your Post</h2>
						</div>
                        <input type="hidden" name="temp" id="temp" value="{{ $res->content_post }}" />
					<form>
                    <input type="hidden" name="id_post" id="id_post" value="{{ $res->id_post }}" />
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="title" id="title" value="{{ $res->title_post }}" placeholder="Post Title">
									</div>
								</div>
								<div class="col-md-12">
									<div id="summernote" name="summernote">Post Content</div>
								</div>
								<div class="col-md-12">
										Select image to upload:
										<input type="file" name="imagefile" id="imagefile"><br/>
									</div>
								</div>
								<button type="button" class="primary-button" onclick="updatepost()">Update</button>
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
		$(document).ready(function() {
			$('#summernote').summernote();
            $('.note-editable').html($('#temp').val());
		  });
		  
		  function updatepost(){
			// var markupStr =$(".summernote").summernote("code");
			var title = $('#title').val();
			var content = $('.note-editable').html();
			console.log(content);
			var token = $('#_token').val();
            var id_post = $('#id_post').val();
			// window.location.href = "insert-post";
			var file = document.getElementById('imagefile').files[0];
			var formData = new FormData();
			formData.append('image_post', file);
			formData.append('title_post', title);
			formData.append('content_post', content);
			formData.append('_token', token);
			$.ajax({
				type: 'POST',
				url: '../update-post/'+id_post,
				data: formData,
				processData: false,
				contentType: false,
				success: function(result){
					if (result == "good"){
						alert("Update Post Success!");
						window.location.href = "/author";
					} else {
						alert("Create Post Fail!");
					}
				}
			});
		  }
	</script>
	@endsection
