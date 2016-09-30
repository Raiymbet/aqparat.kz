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
        $columnists = Admin::columnistsAndJournalists()->get();
        //dd($columnists);
        return view('admin.news', ['news' => $news, 'categories' => Category::all(), 'columnists' => $columnists]);
    }

    public function getAddNew()
    {
        return view('admin.addnew', ['categories' => Category::all()]);
    }

    public function postAddNew(Request $request)
    {
        $messageType = 'success';
        $message = "Жаңалық сәтті құрылды!";

        $imageHas = false;
        $videoHas = false;

        if($request->ajax()){
            if($request->hasFile('image')){
                if ($request->file('image')->isValid()) {
                    $file = $request->file('image');
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
                        return response()->json(['messageType' => $messageType, 'message' => $message]);
                    }
                    else{
                        $imageHas = true;
                    }
                }
            }
            if($request->hasFile('video')){
                if($request->file('video')->isValid()){
                    $file = $request->file('video');
                    $fileArray = array('video' => $file);
                    $rules = array(
                        'video' => 'mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv|max:100000'
                    );
                    $validator = Validator::make($fileArray, $rules);
                    if($validator->fails()){
                        $messageType = 'error';
                        $message = '';
                        $errors = $validator->errors();
                        foreach ($errors->get('video') as $messageOf) {
                            $message .= $messageOf."\n";
                        }
                        return response()->json(['messageType' => $messageType, 'message' => $message]);
                    }
                    else{
                        $videoHas = true;
                    }
                }
            }
            if($imageHas){
                $imageName = $request->file('image')->getClientOriginalName();
                $text = $request->input('text');

                $new = new News();
                $new->title = $request->input('title');
                $new->author_id = Auth::guard('admin')->user()->id;
                $new->category_id = $request->input('category');
                $new->short_description = $request->input('short_description');
                $new->media_author = $request->input('media_author');
                $new->tags = $request->input('keywords');
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
                //$image = Image::make(public_path($new->avatar_picture));
                //$image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
                $new->avatar_picture = 'news/'.$directory.'/'.$imageName;

                if($videoHas){
                    $videoName = $request->file('video')->getClientOriginalName();
                    $request->file('video')->move($destinationPath, $videoName);
                    $new->video_url = 'news/'.$directory.'/'.$videoName;
                }

                if($request->has('trashFiles')){
                    //dd('Has trash files. And we need move to news directory.');
                    $trashFiles = $request->input('trashFiles');
                    $files_src = explode(',', $trashFiles);
                    foreach ($files_src as $file){
                        $pieces = explode('/', $file);
                        $trashDirectory = $pieces[count($pieces)-2];
                        $file_name = array_pop($pieces);
                        $old_path =  public_path().'\\trash\\'.$trashDirectory.'\\'.$file_name;
                        $new_path = public_path().'\\news\\'.$directory.'\\'.$file_name;

                        if(File::exists(public_path('trash\\'.$trashDirectory.'\\'.$file_name))){
                            File::move($old_path, $new_path);
                            File::delete($old_path);
                        }
                        if (strpos($text, $file) !== false) {
                            $text = str_replace($file, url('/news/'.$directory.'/'.$file_name), $text);
                            //return $text;
                        }

                    }
                    //return  response()->json(['messageType' => 'success', 'message' => 'Trash files moved. And text replaced.']);
                }

                $new->text = $text;
                $new->save();

                if($request->has('postId')){
                    $post = Post::find($request->input('postId'));
                    $post->news_id = $new->id;
                    $post->save();

                    //Notify user about your post is published
                    $receivedUser = $new->posts->user;

                    $receivedUser->newNotification()
                        ->withType('NewsPublished')
                        ->withSubject('Your posted new is published.')
                        ->withBody('Your posted new is published. Thanks for information')
                        ->regarding($new)
                        ->deliver();
                }
            }else{
                $messageType = 'error';
                $message = "News can't be created, because you don't choose image file!";
                return  response()->json(['messageType' => $messageType, 'message' => $message]);
            }

            return response()->json(['messageType' => $messageType, 'message' => $message]);
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
                $new->short_description = $request->input('short_description');
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
        }else if(count($sliders)>=5){
            $slider = SliderNew::orderBy('updated_at', 'asc')->first();
            //Delete image and thumbnail from slider
            //File::delete(public_path($destinationOfImage.$slider->news->id.'.jpg'));
            //File::delete(public_path($destinationOfThumbnail.$slider->news->id.'.jpg'));
            //Create new image and thumbnail for slider
            //$image = Image::make(public_path($new->avatar_picture));
            //$image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
            //$image->resize(85, 48)->save(public_path($destinationOfThumbnail.$new->id.'.jpg'));
            //update slider data
            $slider->new_id = $new->id;
            $slider->save();

            $message = "Жаңалық слайды ретінде қабылданып жаңартылды.";
            $message_type = "success";
        }else{
            //$image = Image::make(public_path(''.$new->avatar_picture));
            //$image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
            //$image->resize(85, 48)->save(public_path($destinationOfThumbnail.$new->id.'.jpg'));

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
