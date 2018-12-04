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
					<form>
                    <input type="hidden" name="id_author" id="id_author" value="{{ $res->id }}" />
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
								</div>
								<button type="button" class="primary-button" onclick="updateprofile()">Update</button>
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
			// window.location.href = "insert-post";
			$.ajax({
				type: 'PUT',
				url: '../update-author/' + id_author,
				data: {
					name: name,
                    email: email,
					_token: token
				},
				success: function(result){
					alert("Edit Profile Success!");
					window.location.href = "/author";
				}
			});
		  }
	</script>
	@endsection
