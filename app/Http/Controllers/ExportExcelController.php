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

    /**
     * @SWG\Get(
     *   path="/excel-export",
     *   description="Return excel report page view",
     *   @SWG\Response(response=200, description="Successful"),
     *   @SWG\Response(response=404, description="Not Found"),
     *   @SWG\Response(response=406, description="Unacceptable"),
     *   @SWG\Response(response=500, description="Internal Server Error")
     * )
     *
     */
    function show_excel(){
        $user_data = DB::table('users')->get();
        return view('rest.excel-export-rest')->with('user_data',$user_data);
    }   
}
