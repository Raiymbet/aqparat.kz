<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use Validator;
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


