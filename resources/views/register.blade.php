@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
                <div class="content">
                    <form class="" action="index.html" method="POST">
                        <input type="text" name="name" value="">
                        <br>
                        <input type="text" name="email" value="">
                        <br>
                        <input type="password" name="password" value="">
                        <br>
                        <input type="text" name="token" value="{{csrf_token()}}">
                        <br>
                        <button type="submit" name="button">Register</button>   
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
