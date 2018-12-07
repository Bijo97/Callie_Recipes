@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<h1 class="text-uppercase">Add Posts</h1>
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
							<h2 class="title">Post your recipe</h2>
						</div>
					<form>
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="title" id="title" placeholder="Post Title">
									</div>
								</div>
								<div class="col-md-12">
									<div id="summernote" name="summernote">Post Content</div>
								</div>
								<button type="button" class="primary-button" onclick="insertpost()">Submit</button>
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
		  });
		  
		  function insertpost(){
			// var markupStr =$(".summernote").summernote("code");
			var title = $('#title').val();
			var content = $('.note-editable').html();
			console.log(content);
			var token = $('#_token').val();
			// window.location.href = "insert-post";
			$.ajax({
				type: 'POST',
				url: 'insert-post',
				data: {
					id_post: 5,
					id_user: 1,
					id_tags: 2,
					id_category:9,
					title_post:title,
					content_post:content,
					image_post:"da",
					publishdate_post:2018-11-01,
					totalview_post:0,
					_token: token
				},
				success: function(result){
					alert("Create Post Success!");
					window.location.href = "/author";
				}
			});
		  }
	</script>
	@endsection
