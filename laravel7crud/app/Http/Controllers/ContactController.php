<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact',['name'=> 'Contact Us Page']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function contactSubmit(Request $request)
    {
        Mail::send('email.contact-email', [
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'msg' => $request->message
        ],function($mail) use($request){
            $mail->from('myintmarlar.scm@gmail.com', $request->full_name);
            $mail->to("myintmarlar.scm@gmail.com")->subject('Contact Us Message');
        });
        return redirect()->route('contact.index')->with('success', 'Message has been sent successful!');
    }
}
