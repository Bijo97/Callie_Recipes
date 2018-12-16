<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Post</title>
  
</head>
<body>
  <!-- <table>
    <tr>
      <th>Name</th>
      <th>Email</th>
    </tr>
    
  </table> -->
  @foreach ($posts as $post)
    <h1>{{$post->title_post}}</h1>
    <h4>{{$post->publishdate_post}}</h4>
    <p><img src="img/{{$post->image_post}}"></p>
    <p>{!! $post->content_post !!}</p>
  @endforeach
</body>
</html>