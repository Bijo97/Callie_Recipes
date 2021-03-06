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
					<form method="POST" action="insert-post" enctype="multipart/form-data">
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="title" id="title" placeholder="Post Title">
									</div>
								</div>
								<div class="col-md-12">
									<textarea name="content" id="content" placeholder="Post Content"></textarea>
								</div>
								<div class="col-md-12">
									<input type="text" name="tags" id="tags" placeholder="Enter tags">
									<div id="tagsList"></div>
									{{!! csrf_field() !!}}
								</div>
								
								<button type="submit" class="primary-button">Submit</button>
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

			$('#tags').keyup(function()){
				var query = $(this).val();
				if(query != ''){
					var token = $('#_token').val();
					$.ajax({
						url:"{route('tags.fetch')}",
						method:"POST",
						data:{query:query, _token:_token},
						success:function(data){
							$('#tagsList').fadeIn();
							$('#tagsList').html(data);
						}
					})
				}
				
			}
		  });
		  
		  function insertpost(){
			// var markupStr =$(".summernote").summernote("code");
			var title = $('#title').val();
			var content = $('.note-editable').html();
			console.log(content);
			var token = $('#_token').val();
			// window.location.href = "insert-post";
			var formData = new FormData();
			formData.append('title_post', title);
			formData.append('content_post', content);
			formData.append('_token', token);

			$.ajax({
				type: 'POST',
				url: 'insert-post',
				data: formData,
				processData: false,
				contentType: false,
				success: function(result){
					alert(result);
					window.location.href = "/api/add-post-rest";
				}
			});
		  }
	</script>
	@endsection
