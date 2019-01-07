<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;
use Session;
class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function post_contact(Request $request){
        $this->validate($request,[
        'email'=> 'required|email',
        'subject'=>'min:3',
        'message'=>'min:10']); 
        
       $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
       );

        Mail::send('emails.contact', $data ,function($message) use ($data){
            $message->from($data['email']);
            $message->to('hello@devmarketer.io');
            $message->subject($data['subject']);
        });

        Session::flash('success','Your email was sent!');

        return redirect('/')->with('success', 'Thanks! Your message has been sent');
    
    }
}
