@extends('master')

@section('page-header')
<!-- PAGE HEADER -->
<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-offset-1 col-md-10 text-center">
				<h1 class="text-uppercase">Login Page</h1>
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
							<h2 class="title">Login</h2>
						</div>
						<form method="GET" action="{{ url('login-process') }}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="text" name="username" placeholder="Username">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input class="input" type="password" name="password" placeholder="Password">
									</div>
                                    <button class="primary-button">Login</button>
								</div>
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
