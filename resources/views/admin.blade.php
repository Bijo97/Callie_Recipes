@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<div class="author">
					<img class="author-img center-block" src="./img/avatar-2.jpg" alt="">
					<h1 class="text-uppercase">{{ $res->name }}</h1>
					<p class="lead">{{ $res->email }}</p>
					<ul class="author-social">
						<li><a href="#"><i class="fa fa-facebook"></i></a></li>
						<li><a href="#"><i class="fa fa-twitter"></i></a></li>
						<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						<li><a href="#"><i class="fa fa-instagram"></i></a></li>
					</ul><br/>
					<a href="edit-author/{{ $res->id }}"><button type="button" class="primary-button">Edit Profile</button></a>
					<a href="add-post"><button type="button" class="primary-button">Add New Post</button></a>
					<a href="logout"><button type="button" class="primary-button">Log Out</button></a>
				</div>
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
				<div class="col-md-8">
				<h3>All Posts</h3>
					@foreach($res2 as $row)
					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post"><img src="{{ $res->image_post }}" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category">Travel</a>
								<a href="category">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post/{{ $row->id_post }}">{{ $row->title_post }}</a></h3>
							<ul class="post-meta">
								<li><a href="author">{{ $row->name }}</a></li>
								<li>{{ $row->publishdate_post }}</li>
							</ul>
							<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
							<a href="edit-post/{{ $row->id_post }}"><button type="button" class="primary-button">Edit</button></a>
							<button type="button" class="primary-button" onclick="deletepost({{ $row->id_post }})">Delete</button>
						</div>
					</div>
					<!-- /post -->
					@endforeach
				</div>

				<div class="col-md-4">
					<h3>All Users</h3>
					<p><a href="{{ URL::route('data/download/users') }}" class="btn btn-lg btn-primary pull-left">Download Main Meta Data</a></p>
					<!-- ad widget-->
					<div class="aside-widget text-center">
                        @foreach($res3 as $row)
                            {{ $row->name }}<br/>
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                            <a href="edit-author/{{ $row->id }}"><button type="button" class="primary-button">Edit</button></a>
							<button type="button" class="primary-button" onclick="deleteuser({{ $row->id }})">Delete</button><br/>
                        @endforeach
					</div>
					<!-- /ad widget -->
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
		function deletepost(id){
            var token = $('#_token').val();
			// window.location.href = "insert-post";
			$.ajax({
				type: 'DELETE',
				url: 'delete-post/' + id,
                data: {
                    _token: token
                },
				success: function(result){
					alert("Delete Post Success!");
					window.location.href = "admin";
				}
			});
		  }

          function deleteuser(id){
            var token = $('#_token').val();
			// window.location.href = "insert-post";
			$.ajax({
				type: 'DELETE',
				url: 'delete-author/' + id,
                data: {
                    _token: token
                },
				success: function(result){
					alert("Delete User Success!");
					window.location.href = "admin";
				}
			});
		  }

		  function exportcsv(){
			// window.location.href = "insert-post";
			$.ajax({
				type: 'GET',
				url: 'export-csv',
				success: function(result){
					alert("Export CSV Success!");
				}
			});
		  }
	</script>
	@endsection
