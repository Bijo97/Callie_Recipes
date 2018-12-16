<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Users</title>
  
</head>
<body>
  <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
    </tr>
    @foreach ($users as $u)
    <tr>
     <td>{{$u->name}}</td>
     <td>{{$u->email}}</td>
    </tr>
    @endforeach
  </table>
</body>
</html>