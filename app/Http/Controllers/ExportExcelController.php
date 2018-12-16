<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Excel;
use App\Http\Requests;
use App\User;

class ExportExcelController extends Controller
{
    function index(){
        $user_data = DB::table('users')->get();
        return view('export_excel')->with('user_data',$user_data);
    }   
    function excel(){
        $user_data = User::all();
        $user_array[] = array('Name','Email');
        foreach($user_data as $u){
            $user_array[]= array(
                'Name' => $u->name,
                'Email'=>$u->email
            );
        }  
        Excel::create('User Data ',function($excel) use ($user_array){
            $excel->setTitle('User Data');
            $excel->sheet('User Data',function($sheet) use ($user_array){
                $sheet->fromArray($user_array,null,'A1',false,false);
            });
        })->download('xlsx');
    }
}
