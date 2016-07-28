<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;

class AdminCategoriesController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getCategories()
    {
        return view('admin.categories', [
            'categories' => Category::all(),
        ]);
    }

    public function getDestroy(Request $request, $id)
    {
        if($request->ajax()){
            //$this->authorize('destroy', $post);
            $category = Category::find($id);
            $category->delete();
            return "OK";
        }
    }

    public function postAdd(Request $request)
    {
        if($request->ajax()){
            $category = new Category();
            $category->name = $request->input('name');
            $category->save();

            return "".$category->name." санаты сәтті құрылды!";
        }
    }

    public function postEdit(Request $request, $id)
    {
        if($request->ajax()){
            $category = Category::find($id);
            $category->name = $request->input('name');
            $category->save();

            return "Санат сәтті өзгертілді!";
        }
    }
}
