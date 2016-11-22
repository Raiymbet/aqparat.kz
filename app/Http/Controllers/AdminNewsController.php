<?php

namespace App\Http\Controllers;

use App\Category;
use App\News;
use App\Post;
use App\SliderNew;
use App\Translate;
use Illuminate\Http\Request;

use ReflectionClass;

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
        if(Auth::guard('admin')->user()->type == 'admin' || Auth::guard('admin')->user()->type == 'moderator'){
            $news = News::orderBy('created_at', 'desc')->paginate(6);
            $columnists = Admin::columnistsAndJournalists()->get();
            return view('admin.news', ['news' => $news, 'categories' => Category::all(), 'columnists' => $columnists]);
        }else{
            $news = News::where('author_id', '=', Auth::guard('admin')->id())->orderBy('created_at', 'desc')->paginate(6);
            $columnists = Admin::columnistsAndJournalists()->get();
            return view('admin.news', ['news' => $news, 'categories' => Category::all()]);
        }
        //dd($columnists);
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
                $new->media_author = $request->input('media_author');
                $new->tags = $request->input('tags');
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
        $new = News::find($id);
        $new_avatar = $new->avatar_picture;
        //Delete all relational data of this new -> comments - replies, likes; likes, translates, post
        //dd($new->comments(), $new->likes(), $new->translates(), $new->posts(), $new->sliderNew());
        if($new->comments()->get()->count() > 0){
            $comments = $new->comments()->get();
            foreach ($comments as $comment){
                //dd($comment->replies()->get()->count(), $comment->likes()->get()->count());
                if($comment->replies()->get()->count()>0){
                    foreach ($comment->replies()->get() as $replies){
                        //dd($replies->delete());
                        $replies->delete();
                    }
                }
                //dd($comment, $comment->commentLikes()->withTrashed()->get());
                if($comment->commentLikes()->withTrashed()->get()->count() > 0){
                    //dd($comment->commentLikes()->get());
                    foreach ($comment->commentLikes()->withTrashed()->get() as $like){
                        //dd($likes->delete());
                        $like->forceDelete();
                    }
                }
                $comment->delete();
            }
        }
        if($new->newLikes()->withTrashed()->get()->count() > 0){
            $likes = $new->newLikes()->withTrashed()->get();
            //dd($likes);
            foreach ($likes as $like){
                //dd($like->forceDelete());
                $like->forceDelete();
            }
        }
        if($new->translates()->get()->count() > 0){
            $translates = $new->translates()->get();
            //dd($translates);
            foreach ($translates as $translate){
                //dd($translate->delete());
                $translate->delete();
            }
        }
        if($new->posts()->get()->count() > 0){
            $posts = $new->posts()->get();
            //dd($posts);
            foreach ($posts as $post){
                //dd($translate->delete());
                $post->delete();
            }
        }
        if($new->sliderNew()->get()->count() > 0){
            //dd($new->sliderNew()->get());
            foreach ($new->sliderNew()->get() as $slider){
                //dd($slider->delete());
                $slider->delete();
            }
        }
        $new->delete();
        File::delete($new_avatar);
        return "OK";
    }

    public function getPublishNew(Request $request, $id){
        if($request->ajax() && Auth::guard('admin')->user()->type == 'admin'){
            $new = News::find($id);
            $new->published=!$new->published;
            $new->save();
            return "OK";
        }else{
            return response()->json(['message' => 'You can\'t change status!']);
        }
    }

    public function getSetAsSliderNew(Request $request, $id){
        //$destinationOfImage = 'data0\\images\\';
        //$destinationOfThumbnail = 'data0\\tooltips\\';

        $new = News::find($id);
        if(SliderNew::where('new_id', $new->id)->exists()){
            $slider = SliderNew::where('new_id', '=', $new->id)->first();
            //dd($slider, $new);
            //dd($slider->delete());
            $slider->delete();

            $message = "Жаңалық слайд жаңылығынан алынып тасталды.";
            $message_type = "success";
        }else if(count(SliderNew::all())>=5){
            $slider = SliderNew::orderBy('updated_at', 'asc')->first();
            $slider->delete();
            //Delete image and thumbnail from slider
            //File::delete(public_path($destinationOfImage.$slider->news->id.'.jpg'));
            //File::delete(public_path($destinationOfThumbnail.$slider->news->id.'.jpg'));
            //Create new image and thumbnail for slider
            //$image = Image::make(public_path($new->avatar_picture));
            //$image->resize(1600, 900)->save(public_path($destinationOfImage.$new->id.'.jpg'));
            //$image->resize(85, 48)->save(public_path($destinationOfThumbnail.$new->id.'.jpg'));
            //update slider data

            $newslider = new SliderNew();
            $newslider->new_id = $new->id;
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
            $new_translate->short_description = $request->input('short_description');
            $new_translate->tags = $request->input('keywords');
            $new_translate->media_author = $new->media_author;
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
