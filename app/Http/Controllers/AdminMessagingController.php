<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;

class AdminMessagingController extends Controller
{
    protected $redirectTo = '/admin';
    protected $guard = 'admin';

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getMessaging(Request $request)
    {
        $users = User::groupBy('email')->get();
        return view('admin.messaging')->with( 'users', $users);
    }

    public function postMessaging(Request $request){
        $users = $request->input('users');
        $toUsersAll = $request->input('toUsersAll');
        $template = $request->input('template');
        $subject = $request->input('subject');
        $content = $request->input('content');


        if($toUsersAll == "true"){
            $users = User::distinct()->get(['email']);
            //dd($toUsersAll);
        }
        $data = [
            'users' => $users,
            'subject' => $subject,
            'content' => $content
        ];
        if($template == "custom"){
            //dd($template);
            Mail::send('common.custom_email', $data, function($message) use ($data){
                $message->to('info@aqparat.kz')->bcc($data['users'])
                    ->subject($data['subject']);
            });
        }else{
            return  response()->json(['messageType' => 'error', 'message' => 'You don\'t have any template!']);
        }

        return  response()->json(['messageType' => 'success', 'message' => 'Messages send. Thank\'s!']);;
    }
}
