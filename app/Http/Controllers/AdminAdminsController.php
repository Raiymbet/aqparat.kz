<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

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
            $password = str_random(8);
            $admin = new Admin();
            $admin->name = $request->input('name');
            $admin->email = $request->input('email');
            $admin->type = $request->input('type');
            $admin->password = bcrypt($password);

            $data = [
                'name' => $admin->name,
                'email' => $admin->email,
                'password' => $password,
            ];

            Mail::raw($data, function($message) use ($data)
            {
                $message->from('tukpetov@bk.ru', 'Raiymbet Tukpetov');
                $message->to($data['email'])->subject('Aqparat.kz сайтының жаңа қолданушысы ');
            });

            $admin->save();
            return "".$admin->name." қолданушысы сәтті құрылды!";
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
