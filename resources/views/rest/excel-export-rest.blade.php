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
                <td>Action</td>
            </tr>
            @foreach($user_data as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->email}}</td>
                <td><input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                            <a href="edit-author/{{ $u->id }}"><button type="button" class="primary-button">Edit</button></a>
                            <form method="POST" action="delete-user/{{ $u->id }}">
                                <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="id_post" id="id_post" value="{{$u->id }}" />
					<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" />
                            <button type="submit" class="primary-button">Delete</button><br/></td>
                            </form>
            </tr>
            @endforeach
        </table>
    
    </div>
</div>
@endsection

@section('js')
<script>
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
				window.location.href = "excel_export";
			}
		});
	}
</script>
@endsection