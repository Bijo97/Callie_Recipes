<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\User;
use App\Post;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

 

    public function show_about()
    {
        return view('about');
    }

    public function show_author()
    {
        $id = Auth::id();

        if ($id != null){
            $res = User::where("id", $id)->first();
            $res2 = Post::where('id_user', $id)->orderBy('publishdate_post', 'desc')->get();

            return view('author')->with("res", $res)->with("res2", $res2);
        } else {
            return redirect('login');
        }
    }

    public function show_admin()
    {
        $id = Auth::id();

        if ($id != null){
            $res = User::where("id", $id)->first();
            $res2 = Post::join("users", "users.id", "=", "post.id_user")->orderBy('publishdate_post', 'desc')->get();
            $res3 = User::all();

            return view('admin')->with("res", $res)->with("res2", $res2)->with("res3", $res3);
        } else {
            return redirect('login');
        }
    }

    public function show_blank()
    {
        return view('blank');
    }


    public function show_contact()
    {
        return view('contact');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
