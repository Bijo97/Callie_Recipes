<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Post;
use App\User;

use Intervention\Image\ImageManagerStatic as Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog-post');
    }

    public function getPost($id)
    {
        // $res = Post::where('id_post', $id)->first();
        $res = Post::join('users', 'post.id_user', '=', 'users.id')->where('post.id_post', $id)->select('post.*', 'users.name')->first();

        return view('blog-post')->with("res", $res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($image = $request->file('image_post')) {
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());      
            $watermark =  Image::make('img/logo.png');        
            $image_resize->resize(250, 250);
             //#1
             $watermarkSize = $image_resize->width() - 5; //size of the image minus 20 margins
             //#2
             $watermarkSize = $image_resize->width() / 2; //half of the image size
             //#3
             $resizePercentage = 30;//10% less then an actual image (play with this value)
             $watermarkSize = round($image_resize->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
 
             // resize watermark width keep height auto
             $watermark->resize($watermarkSize, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
             $image_resize->insert($watermark, 'bottom-right');
            $image_resize->save('img/'.$filename);

            $image_pixelate = Image::make($image->getRealPath()); 
            $image_pixelate->resize(250, 250);
            $image_pixelate->pixelate(12);
            $image_pixelate->insert($watermark, 'bottom-right');
            $image_pixelate->save('img/'."pixelate_".$filename);

            $id = Post::max("id_post");
            $row = new Post;
            $row->id_post = $id + 1;
            $row->id_user = Auth::id();
            $row->id_tags = 2;
            $row->id_category = 9;
            $row->title_post = $request->input("title_post");
            $row->content_post = $request->input("content_post");
            $row->image_post = $filename;
            $row->publishdate_post = date("Y-m-d");
            $row->totalview_post = 0;
            // $row->fill($request->all());
            $row->save();

            echo "good";
        } else {
            echo "bad";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function show_add_post()
    {
        $id = Auth::id();

        if ($id != null){
            return view('add-post');
        } else {
            return redirect('login');
        }
    }

    public function show_edit_post($id_post)
    {
        $id = Auth::id();

        if ($id != null){
            $res = Post::where('id_post', $id_post)->first();
            return view('edit-post')->with('res', $res);
        } else {
            return redirect('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($image = $request->file('image_post')) {
            $filename = $image->getClientOriginalName();
            $watermark =  Image::make('img/logo.png');
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(250, 250);
            $img_name = "img/".$filename;
             //#1
             $watermarkSize = $image_resize->width() - 5; //size of the image minus 20 margins
             //#2
             $watermarkSize = $image_resize->width() / 2; //half of the image size
             //#3
             $resizePercentage = 30;//10% less then an actual image (play with this value)
             $watermarkSize = round($image_resize->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
 
             // resize watermark width keep height auto
             $watermark->resize($watermarkSize, null, function ($constraint) {
                 $constraint->aspectRatio();
             });
             $image_resize->insert($watermark, 'bottom-right');
            $image_resize->save($img_name);

            $image_pixelate = Image::make($image->getRealPath()); 
            $image_pixelate->resize(250, 250);
            $image_pixelate->pixelate(12);
            $image_pixelate->insert($watermark, 'bottom-right');
            $image_pixelate->save('img/'."pixelate_".$filename);

            $row = Post::where('id_post', $id)->update(['title_post' => $request->input('title_post'), 'content_post' => $request->input('content_post'),'image_post'=>$filename]);
            echo "good";
        } else {
            echo "bad";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Post::where('id_post', $id)->delete();
    }

    /**
     * @SWG\Get(
     *   path="/add-post-rest",
     *   description="Return add post page view",
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function add_post_rest(){
        return view('rest.add-post-rest');
    }

    /**
     * @SWG\Get(
     *   path="/edit-post-rest/{id}",
     *   description="Return edit post page view",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Post ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function edit_post_rest($id){
        $res = Post::where('id_post', $id)->first();

        return view('rest.edit-post-rest')->with("res", $res);
    }

    /**
     * @SWG\Get(
     *   path="/blog-post",
     *   description="Return all posts page view",
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function show_json()
    {
        // $res = Post::where('id_post', $id)->first();
        $res = Post::all();

        return response()->json($res, 200);
    }

    /**
     * @SWG\Get(
     *   path="/blog-post/{id}",
     *   description="Return selected post page view",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Post ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function show_detail_json($id)
    {
        // $res = Post::where('id_post', $id)->first();
        $res = Post::where('id_post', $id)->first();

        return response()->json($res, 200);
    }

    /**
     * @SWG\Post(
     *   path="/insert-post",
     *   description="Insert a new post",
     *   @SWG\Parameter(
     *     name="Post",
     *     in="body",
     *     description="Post's Content",
     *     required=true,
     *     type="string",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="title", type="string"),
     *         @SWG\Property(property="content", type="string")
     *     )
     *   ),
     *   @SWG\Response(response=201, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function store_json(Request $request)
    {
        $id = Post::max("id_post");
        $row = new Post;
        $row->id_post = $id + 1;
        $row->id_user = 1;
        $row->id_tags = 2;
        $row->id_category = 9;
        $row->title_post = $request->input("title");
        $row->content_post = $request->input("content");
        $row->image_post = "da";
        $row->publishdate_post = date("Y-m-d");
        $row->totalview_post = 0;
        // $row->fill($request->all());
        $row->save();

        return response()->json($row, 201);
    }

    /**
     * @SWG\Put(
     *   path="/update-post/{id}",
     *   description="Update selected post's content",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Post ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Parameter(
     *     name="Author",
     *     in="body",
     *     description="Author's Data",
     *     required=true,
     *     type="string",
     *     @SWG\Schema(
     *         type="object",
     *         @SWG\Property(property="title", type="string"),
     *         @SWG\Property(property="content", type="string")
     *     )
     *   ),
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function update_json(Request $request, $id)
    {
        $row = Post::where('id_post', $id)->update(['title_post' => $request->input('title'), 'content_post' => $request->input('content'),'image_post'=>"da"]);
        
        return response()->json($row, 200);
    }

    /**
     * @SWG\Delete(
     *   path="/delete-post/{id}",
     *   description="Delete selected post's content",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Post ID",
     *     required=true,
     *     type="integer"
     *   ),
     *   @SWG\Response(response=204, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    public function destroy_json($id)
    {
        $row = Post::where('id_post', $id)->delete();

        return response()->json($row, 204);
    }
}
