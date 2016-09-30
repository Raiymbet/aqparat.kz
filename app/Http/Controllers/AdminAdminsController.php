<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Requests;

class AdminAdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getAdmins()
    {
        return view('admin.admins', [
            'admins' => Admin::all(),
        ]);
    }

    public function getDestroy(Request $request, $id)
    {
        if($request->ajax()){
            $admin = Admin::find($id);
            $admin->delete();
            return "OK";
        }
    }

    public function postAdd(Request $request)
    {
        if($request->ajax()){

            if (Admin::where('email', '=', $request->input('email'))->exists()) {
                // user found
                $messageType = 'error';
                $message = 'User with this email exists. Please, enter other email!';
                return response()->json(['messageType' => $messageType, 'message' => $message]);
            }

            $password = str_random(8);
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->type = $request->input('type');
            $admin->password = bcrypt($password);

            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $password,
            ];

            //dd(Config::get('mail'));

            Mail::send('common.email', $data, function($message) use ($data){
                $message->from('info@aqparat.kz', 'Aqparat.kz');
                $message->to($data['email'], $data['name'])->subject('Aqparat.kz сайтының жаңа қолданушысы');
            });

            $admin->save();

            $messageType = 'success';
            $message = "".$admin->name." қолданушысы сәтті құрылды!";
            return response()->json(['messageType' => $messageType, 'message' => $message]);
        }
    }

    public function postEdit(Request $request, $id)
    {
        if($request->ajax()){
            $admin = Admin::find($id);
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->type = $request->input('type');
            $admin->save();

            return "".$admin->name." қолданушысы сәтті өзгертілді!";
        }
    }
}
