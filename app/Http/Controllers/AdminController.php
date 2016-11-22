<?php

namespace App\Http\Controllers;

use App\AdminDetail;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use Intervention\Image\Facades\Image;
use Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AdminController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard = 'admin';

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function adminHome(Request $request)
    {
        return view('admin.home');
    }

    public function getProfile()
    {
        return view('admin.profile');
    }

    public function postProfile(Request $request)
    {
        if($request->ajax()){

            $message = "Сіз өзіңіздің профиль мәліметтерін сәтті жаңарттыңыз!";
            $message_type = "success";

            $admin_id = Auth::guard('admin')->user()->id;
            $admin = Admin::find($admin_id);
            if(AdminDetail::where('admin_id', $admin_id)->exists()){
                $admin_details = AdminDetail::where('admin_id', $admin_id)->first();
            }else{
                $admin_details = new AdminDetail();
            }

            if($request->hasFile('avatar')){
                if ($request->file('avatar')->isValid()) {
                    $imageName = $request->file('avatar')->getClientOriginalName();
                    $destinationPath = base_path().'/public/img/profile/';
                    if(File::exists(public_path('img\\profile\\'.$imageName))){
                        $message_type = "error";
                        $message = "Мұндай атаумен аталған сурет бар, атауын өзгертіп қайта жүктеңіз.";
                    }else{
                        if($admin->avatar !== 'img/default_user.png'){
                            $file_image_delete = str_replace('/', '\\', $admin->avatar);
                            File::delete(public_path($file_image_delete));
                        }
                        $request->file('avatar')->move($destinationPath, $imageName);
                        $admin->avatar = 'img/profile/'.$imageName;
                    }
                }else{
                    $message_type = "error";
                    $message = "Суретті жүктеуде қателік бар! Файл сурет екеніне көз жеткізіңіз.";
                }
            }

            $admin->name = $request->input('username');
            $admin->email = $request->input('email');
            //$admin->password = $request->input('password');
            $admin->save();

            $admin_details->admin_id = $admin_id;
            $admin_details->about = $request->input('about');
            $admin_details->location = $request->input('location');
            $admin_details->facebook = ($request->input('facebook')=='')?null:$request->input('facebook');
            $admin_details->twitter = ($request->input('twitter')=='')?null:$request->input('twitter');
            $admin_details->linkedIn = ($request->input('linkedIn')=='')?null:$request->input('linkedIn');
            $admin_details->googlePlus = ($request->input('googlePlus')=='')?null:$request->input('googlePlus');
            $admin_details->save();

            return  response()->json(['message_type' => $message_type, 'message' => $message]);
        }
    }

    public function postImageUpload(Request $request){
        if($request->ajax()){
            if($request->hasFile('file')){
                if ($request->file('file')->isValid()) {
                    $file = $request->file('file');
                    $fileArray = array('image' => $file);
                    $rules = array(
                        'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
                    );
                    $validator = Validator::make($fileArray, $rules);
                    if($validator->fails()){
                        $messageType = 'error';
                        $message = '';
                        $errors = $validator->errors();
                        foreach ($errors->get('image') as $messageOf) {
                            $message .= $messageOf."\n";
                        }
                        return "Invalid mimes";
                    }
                    else{
                        $imageName = $request->file('file')->getClientOriginalName();
                        $directory = ''.Auth::guard('admin')->id();
                        $destinationPath = base_path().'/public/trash/'.$directory;

                        $request->file('file')->move($destinationPath, $imageName);
                        $image = Image::make(public_path('trash\\'.$directory.'\\'.$imageName));
                        $image->resize(741, 388)->save(public_path('\\trash\\'.$directory.'\\'.$imageName));
                        $src = url('/trash/'.$directory.'/'.$imageName);
                        return $src;
                    }
                }
            }
        }
    }

    public function getUsers(Request $request){
        $users = User::paginate(30);
        //dd($users);
        return view('admin.users')->with('users', $users);
    }

    public function postTrashClean(Request $request){
        $files = $request->input('files');
        $message = 'File do not exists';
        foreach ($files as $file){
            $pieces = explode('/', $file);
            $directory = $pieces[count($pieces)-2];
            $file_name = array_pop($pieces);
            if(File::exists(public_path('trash\\'.$directory.'\\'.$file_name))){
                File::delete(public_path('trash\\'.$directory.'\\'.$file_name));
                $message = 'File exists and deleted';
            }
        }
        return $message;
    }

    public function getNews(Request $request)
    {
        return view('admin.news');
    }

    public function getAddNews()
    {
        return view('admin.addnew');
    }

    public function getCategories()
    {
        return view('admin.categories');
    }

    public function getSearch()
    {
        return view('admin.search');
    }

    public function getAdmins()
    {
        return view('admin.admins', ['admins' => Admin::all()]);
    }

    public function getComments()
    {
        return view('admin.comments');
    }
}


