<h1>Post List</h1>
<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Title</th>
      <th>Content</th>
      <th>Publish Date</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $row)
      <tr>
        <td>{{ $row->id_post }}</td>
        <td>{{ $row->title_post }}</td>
        <td>{{ $row->content_post }}</td>
        <td>{{ $row->publishdate_post }}</td>
      </tr>
    @endforeach
  </tbody>
</table>