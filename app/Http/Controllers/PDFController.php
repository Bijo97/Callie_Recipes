<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use PDF;
use App\Http\Requests;

class PDFController extends Controller
{
    public function pdf(){
        $users = User::all();
        $pdf = PDF::loadView('pdf',['users' => $users]);
        return $pdf->download('users.pdf');
    }
}
