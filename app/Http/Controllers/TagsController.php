<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Tags;
use App\Http\Requests;

class TagsController extends Controller
{
    //

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('tags')
        ->where('name_tags', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->name_tags.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
