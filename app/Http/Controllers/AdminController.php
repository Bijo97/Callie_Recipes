<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Post;
use App\User;

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
        $id = Post::max("id_post");

        $row = new Post;
        $row->id_post = $id + 1;
        $row->id_user = Auth::id();
        $row->id_tags = 2;
        $row->id_category = 9;
        $row->title_post = $request->input("title_post");
        $row->content_post = $request->input("content_post");
        $row->image_post = $request->input("image_post");
        $row->publishdate_post = date("Y-m-d");
        $row->totalview_post = 0;
        // $row->fill($request->all());
        $row->save();
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
        $row = User::where('id', $id)->update(['name' => $request->input('name'), 'email' => $request->input('email')]);
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
        $row = Post::where('id_post', $id)->update(['title_post' => $request->input('title_post'), 'content_post' => $request->input('content_post')]);
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
