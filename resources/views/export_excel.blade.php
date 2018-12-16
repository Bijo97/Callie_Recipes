@extends('master')
@section('content')
<div class="container">
    <h3 align="center">Export Data to Excel in Laravel</h3>
    <br/>
    <div align="center">
        <a href="{{route('export_excel.excel')}}" class="btn btn-success"> Export to excel </a>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <tr>
                <td>Name</td>
                <td>Email</td>
            </tr>
            @foreach($user_data as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
            </tr>
            @endforeach
        </table>
    
    </div>
</div>
@endsection