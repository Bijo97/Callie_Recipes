@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<div class="author">
					<img class="author-img center-block" src="../{{ $res->image_user }}" alt="">
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
					@foreach($res2 as $row)
					<!-- post -->
					<div class="post post-row">
						<a class="post-img" href="blog-post"><img src="../{{ $row->image_post }}" alt=""></a>
						<div class="post-body">
							<div class="post-category">
								<a href="category">Travel</a>
								<a href="category">Lifestyle</a>
							</div>
							<h3 class="post-title"><a href="blog-post/{{ $row->id_post }}">{{ $row->title_post }}</a></h3>
							<ul class="post-meta">
								<li><a href="author">{{ $res->name }}</a></li>
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
					<!-- ad widget-->
					<div class="aside-widget text-center">
						<a href="#" style="display: inline-block;margin: auto;">
							<img class="img-responsive" src="./img/ad-3.jpg" alt="">
						</a>
					</div>
					<!-- /ad widget -->

					<!-- social widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Social Media</h2>
						</div>
						<div class="social-widget">
							<ul>
								<li>
									<a href="#" class="social-facebook">
										<i class="fa fa-facebook"></i>
										<span>21.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-twitter">
										<i class="fa fa-twitter"></i>
										<span>10.2K<br>Followers</span>
									</a>
								</li>
								<li>
									<a href="#" class="social-google-plus">
										<i class="fa fa-google-plus"></i>
										<span>5K<br>Followers</span>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /social widget -->

					<!-- category widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Categories</h2>
						</div>
						<div class="category-widget">
							<ul>
								<li><a href="#">Lifestyle <span>451</span></a></li>
								<li><a href="#">Fashion <span>230</span></a></li>
								<li><a href="#">Technology <span>40</span></a></li>
								<li><a href="#">Travel <span>38</span></a></li>
								<li><a href="#">Health <span>24</span></a></li>
							</ul>
						</div>
					</div>
					<!-- /category widget -->

					<!-- newsletter widget -->
					<div class="aside-widget">
						<div class="section-title">
							<h2 class="title">Newsletter</h2>
						</div>
						<div class="newsletter-widget">
							<form>
								<p>Nec feugiat nisl pretium fusce id velit ut tortor pretium.</p>
								<input class="input" name="newsletter" placeholder="Enter Your Email">
								<button class="primary-button">Subscribe</button>
							</form>
						</div>
					</div>
					<!-- /newsletter widget -->
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
					window.location.href = "author";
				}
			});
		  }
	</script>
	@endsection
