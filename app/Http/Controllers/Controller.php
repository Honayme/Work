<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function contact(){
        return view('index');
    }

    public function postcontact(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:3',
            'bodyMessage' => 'min:10'
        ]);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message,
            'name' => $request->name
        );


        Mail::send('contact', $data, function($message) use ($data){
            $message->from($data["email"]);
            $message->to('adresseemaildelta@mail.com'); //Digitalmail
            $message->subject($data['subject']);
        });


        Mail::send('contact', $data, function($message) use ($data){
            $message->from($data["email"]);
            $message->to($data["email"]); //Digitalmail
            $message->subject($data['subject']);
        });

        return view('index');

    }
}
