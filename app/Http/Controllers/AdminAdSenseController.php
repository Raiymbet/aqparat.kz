<?php

namespace App\Http\Controllers;

use App\Admin;
use App\AdSense;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AdminAdSenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getAdSense()
    {
        return view('admin.adSense');
    }

    public function postAdSense(Request $request){
        $title = $request->input('title');
        $location = $request->input('location');
        $code = $request->input('code');
        $published = $request->input('published');
        //dd($published);

        $ads = new AdSense();
        $ads->admin()->associate(Auth::guard('admin')->user());
        $ads->title = $title;
        $ads->location = $location;
        $ads->code = $code;
        $ads->published = $published;
        $ads->save();
        //dd($ads);
        return 'success';
    }

    public function getDeleteAdSense(Request $request, $id){
        if($request->ajax()){
            $ads = AdSense::find($id);
            $ads->delete();
            return "OK";
        }
    }

    public function getPublishAdSense(Request $request, $id){
        if($request->ajax()){
            $ads = AdSense::find($id);
            $ads->published=!$ads->published;
            $ads->save();
            return "OK";
        }
    }
}
