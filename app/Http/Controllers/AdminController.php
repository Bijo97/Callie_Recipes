<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests;
use App\Post;
use App\User;

use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {   
        if ($image = $request->file('image_post')) {
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(250, 250);
            $image_resize->save('img/'.$filename);

            $image_pixelate = Image::make($image->getRealPath()); 
            $image_pixelate->resize(250, 250);
            $image_pixelate->pixelate(12);
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

        // if ($file = $request->file('image_post')){
        //     $name = $file->getClientOriginalName();
        //     $file->move('img', $name);
        //     // $input['your_file'] = $name;
        //     echo "good";
        // } else {
        //     echo "bad";
        // }
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function checkImage($image){
        
        if($image){
            $filename = $image->getClientOriginalName();
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(250, 250);
            $img_name = "img/".$filename;
            $image_resize->save($img_name);
           
            // $image_pixelate = Image::make($image->getRealPath()); 
            // $image_pixelate->resize(250, 250);
            // $image_pixelate->pixelate(12);
            // $image_pixelate->save('img/'."pixelate_".$filename);
            return $img_name;   
        }
    }


    public function edit_author($id_user)
    {
        $id = Auth::id();

        if ($id != null){
            $res = User::where('id', $id_user)->first();
            return view('edit-author')->with('res', $res);
        } else {
            return redirect('login');
        }
    }

    public function update_author(Request $request, $id)
    {   
        // $a = $request->file('image_user');
        // $img_name = checkImage($a);

        if($image = $request->file('image_user')){
            
            // $filename = $image->getClientOriginalName();
           $filename = uniqid().'.png';
           $watermark =  Image::make('img/logo.png');
            $image_resize = Image::make($image->getRealPath())->encode('png', 100);  
            // $img = File::get(url('img/logo.png'));
            $image_resize->resize(100, 100);
            
            //#1
            $watermarkSize = $image_resize->width() - 5; //size of the image minus 20 margins
            //#2
            $watermarkSize = $image_resize->width() / 2; //half of the image size
            //#3
            $resizePercentage = 10;//10% less then an actual image (play with this value)
            $watermarkSize = round($image_resize->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image

            // resize watermark width keep height auto
            $watermark->resize($watermarkSize, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            //insert resized watermark to image center aligned
            $image_resize->insert($watermark, 'center');
            $width = $image_resize->getWidth();
            $height = $image_resize->getHeight();
            $mask = Image::canvas($width,$height); 
            
            $mask->circle($width, $width/2, $height/2, function ($draw) {
                $draw->background('#fff');
            });

            $name_circle = 'circle_'.$filename;
            //$image_resize->mask($mask, false);
           
            $image_resize->save('img/'.$name_circle);

            $row = User::where('id', $id)->update(['name' => $request->input('name'), 'email' => $request->input('email'),'image_user'=>$name_circle]);
        }
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
            $image_resize = Image::make($image->getRealPath());              
            $image_resize->resize(250, 250);
            $img_name = "img/".$filename;
            $image_resize->save($img_name);

            $image_pixelate = Image::make($image->getRealPath()); 
            $image_pixelate->resize(250, 250);
            $image_pixelate->pixelate(12);
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
    public function delete($id)
    {
        $row = Post::where('id_post', $id)->delete();
    }
}
