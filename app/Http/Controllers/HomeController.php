<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $id = Auth::id();
        // $res = User::where("id", $id)->first();

        // return view('author')->with("res", $res);
        if (Auth::check()){
            $status = $request->user()->status;
            // dd($status);
            if ($status == 0){
                return redirect('author');
            } else {
                return redirect('admin');
            }
        } else {
            return redirect('login');
        }
    }
    public function store(Request $request)
    {
        
    }
}
