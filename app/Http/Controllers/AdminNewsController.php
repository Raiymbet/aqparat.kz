<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Post;
use App\SliderNew;
use App\Translate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Admin;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AdminNewsController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard = 'admin';

    public function __construct()
    {
        $this->middleware('admin');
    }

    public function getNews(Request $request)
    {
        $news = News::orderBy('created_at', 'desc')->paginate(6);
        return view('admin.news', ['news' => $news, 'categories' => Category::all()]);
    }

    public function getAddNew()
    {
        return view('admin.addnew', ['categories' => Category::all()]);
    }

    public function postAddNew(Request $request)
    {
        if($request->ajax()){

            $image = $request->file('image');

            if($request->hasFile('image')){
                if ($request->file('image')->isValid()) {

                    $imageName = $request->file('image')->getClientOriginalName();

                    $new = new News();
                    $new->title = $request->input('title');
                    $new->author_id = Auth::guard('admin')->user()->id;
                    $new->category_id = $request->input('category');
                    $new->text = $request->input('text');
                    $new->language = $request->input('language');
                    $new->views = 0;
                    $new->shares = 0;
                    $new->likes = 0;

                    //$directory = ''.date('d.m.Y').'/'.$new->id;
                    //if(!Storage::disk('public')->has($directory)){
                    // Storage::disk('public')->makeDirectory($directory);
                    //}
                    //Storage::disk('public')->put($directory.'/'.$imageName, file_get_contents($image -> getRealPath()));
                    //$new->avatar_picture = Storage::url($directory.'/'.$imageName);

                    $directory = ''.date('d.m.Y');
                    $destinationPath = base_path().'/public/news/'.$directory;
                    $request->file('image')->move($destinationPath, $imageName);
                    $new->avatar_picture = 'news/'.$directory.'/'.$imageName;
                    $new->save();

                    if($request->has('postId')){
                        $post = Post::find($request->input('postId'));
                        $post->news_id = $new->id;
                        $post->save();
                    }
                }
            }else{
                $new = new News();
                $new->title = $request->input('title');
                $new->author_id = Auth::guard('admin')->user()->id;
                $new->category_id = $request->input('category');
                $new->text = $request->input('text');
                $new->language = $request->input('language');
                $new->views = 0;
                $new->shares = 0;
                $new->likes = 0;
                $new->save();
            }

            return "Жаңалық сәтті құрылды!";
        }
    }

    public function getSearch()
    {
        return view('admin.search');
    }

    public function getEdit(Request $request, $id)
    {
        $new = News::find($id);
        return view('admin.editnew',['categories' => Category::all(), 'new' => $new]);
    }

    public function postEditNew(Request $request, $id)
    {
        if($request->ajax()){
            $new = News::find($id);
            if($new->author_id===Auth::guard('admin')->user()->id){
                $new->title = $request->input('title');
                //$new->author_id = Auth::guard('admin')->user()->id;
                $new->category_id = $request->input('category');
                $new->text = $request->input('text');
                $new->language = $request->input('language');
                //$new->views = 0;
                //$new->shares = 0;
                //$new->likes = 0;
                $new->save();

                return "Жаңалық сәтті өзгертілді!";
            }else{
                return "Сіз жаңалықты өзгерте алмайсыз!";
            }
        }
    }

    public function getDestroy(Request $request, $id)
    {
        if($request->ajax()){
            $new = News::find($id);
            File::delete($new->avatar_picture);
            //$new->posts()->delete();
            //$new->comments()->delete();
            $new->delete();
            return "OK";
        }
    }

    public function getSetAsSliderNew(Request $request, $id){
        $destinationOfImage = 'data0\\images\\';
        $destinationOfThumbnail = 'data0\\tooltips\\';

        $new = News::find($id);
        $sliders = SliderNew::all();
        if(SliderNew::where('new_id', $new->id)->exists()){
            $message = "Жаңалық слайд ретінде таңдалып қойылған!";
            $message_type = "error";
        }else if(count($sliders)>=6){
            $slider = SliderNew::orderBy('updated_at', 'asc')->first();
            //Delete image and thumbnail from slider
            File::delete(public_path($destinationOfImage.$slider->news->id.'.jpg'));
            File::delete(public_path($destinationOfThumbnail.$slider->news->id.'.jpg'));
            //Create new image and thumbnail for slider
            $image = Image::make(public_path($new->avatar_picture));
            $image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
            $image->resize(85, 48)->save(public_path($destinationOfThumbnail.$new->id.'.jpg'));
            //update slider data
            $slider->new_id = $new->id;
            $slider->save();

            $message = "Жаңалық слайды ретінде қабылданып жаңартылды.";
            $message_type = "success";
        }else{
            $image = Image::make(public_path(''.$new->avatar_picture));
            $image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
            $image->resize(85, 48)->save(public_path($destinationOfThumbnail.$new->id.'.jpg'));

            $slider = new SliderNew();
            $slider->new_id = $new->id;
            $slider->save();

            $message = "Жаңалық слайд жаңалығы ретінде қабылданды.";
            $message_type = "success";
        }
        return  response()->json(['message_type' => $message_type, 'message' => $message]);
    }

    public function getSetAsMainNew(Request $request, $id){
        $new = News::find($id);
        $new->ismainnew = true;
        $new->save();

        return "OK";
    }

    public function getTranslate(Request $request, $id){
        $new = News::find($id);
        $category = Category::find($new->category_id);
        return view('admin.translate', [
            'new' => $new,
            'category' => $category
        ]);
    }

    public function postTranslateNew(Request $request, $id)
    {
        if($request->ajax()){

            $new = News::find($id);

            $new_translate = new News();
            $new_translate->title = $request->input('title');
            $new_translate->author_id = $new->author_id;
            $new_translate->category_id = $new->category_id;
            $new_translate->text = $request->input('text');
            $new_translate->language = $request->input('language');
            $new_translate->avatar_picture = $new->avatar_picture;
            $new_translate->views = 0;
            $new_translate->shares = 0;
            $new_translate->likes = 0;
            $new_translate->save();

            $translate = new Translate();
            $translate->news_id = $id;
            $translate->translate_id = $new_translate->id;
            $translate->save();

            return "Жаңалық сәтті аударылды!";
        }
    }
}
