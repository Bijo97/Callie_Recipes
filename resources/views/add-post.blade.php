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
					<form enctype="multipart/form-data">
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
								<div class="col-md-12">
									
								</div>
								<div class="col-md-12">
									Select image to upload:
									<input type="file" name="imagefile" id="imagefile"><br/>
								</div>

								<button type="button" class="primary-button" onclick="insertpost()">Submit</button>
                            </div>
                            <div class="row">
                                
                            </div>
						</form>
						<div class="form-group">
								<input type="text" name="tags" id="tags" class="form-control input-lg" placeholder="Enter Tag" />
								<div id="tagsList">
								</div>
							   </div>
							   {{ csrf_field() }}
					</div>
					<fieldset id="tagsform">
							<legend>Add your tags!</legend>
					</fieldset>
					<input type="button" value="Add a field" class="add" id="add" />
				</div>
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->
	@endsection

	@section('js')
	<style>
	fieldset
	{
		border: solid 1px #000;
		padding:10px;
		display:block;
		clear:both;
		margin:5px 0px;
	}
	legend
	{
		padding:0px 10px;
		background:black;
		color:#FFF;
	}
	input.add
	{
		float:right;
	}
	input.fieldname
	{
		float:left;
		clear:left;
		display:block;
		margin:5px;
	}
	select.fieldtype
	{
		float:left;
		display:block;
		margin:5px;
	}
	input.remove
	{
		float:left;
		display:block;
		margin:5px;
	}
	</style>
	<script>
		$(document).ready(function() {
			summernote();
			$("#add").click(function() {
				var lastField = $("#tagsform div:last");
				var intId = (lastField && lastField.length && lastField.data("idx") + 1) || 1;
				var fieldWrapper = $("<div class=\"form-group\" id=\"form" + intId + "\" name=\"form"+ intId + "\"/>");
				fieldWrapper.data("idx", intId);
				var fName = $("<input type=\"text\" class=\"fieldname\" />");
				var removeButton = $("<input type=\"button\" class=\"remove\" value=\"-\" />");
				removeButton.click(function() {
					$(this).parent().remove();
				});
				fieldWrapper.append(fName);
				fieldWrapper.append(removeButton);
				$("#tagsform").append(fieldWrapper);
			});
			$('#tags').keyup(function(){ 
					var query = $(this).val();
					if(query != '')
					{
					var _token = $('input[name="_token"]').val();
					$.ajax({
					url:"{{ route('tags.fetch') }}",
					method:"POST",
					data:{query:query, _token:_token},
					success:function(data){
					$('#tagsList').fadeIn();  
						$('#tagsList').html(data);
					}
					});
					}
				});

				$(document).on('click', 'li', function(){  
					$('#tags').val($(this).text());  
					$('#tagsList').fadeOut();  
				});  
		  });
		 
		  function summernote(){
			$('#summernote').summernote();
		  }
		
		  function insertpost(){
			// var markupStr =$(".summernote").summernote("code");
			var title = $('#title').val();
			var content = $('.note-editable').html();
			console.log(content);
			var token = $('#_token').val();
			// window.location.href = "insert-post";
			var file = document.getElementById('imagefile').files[0];
			var formData = new FormData();
			formData.append('image_post', file);
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
					if (result == "good"){
						alert("Create Post Success!");
						window.location.href = "/author";
					} else {
						alert("Create Post Fail!");
					}
				}
			});
		  }
	</script>
	@endsection
