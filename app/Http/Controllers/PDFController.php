<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Post;
use PDF;
use App\Http\Requests;

class PDFController extends Controller
{
    public function pdf($id){
        $posts = Post::where('id_post', $id)->get();
        $pdf = PDF::loadView('pdf',['posts' => $posts]);
        return $pdf->download('post-'.$id.'.pdf');
    }
}
