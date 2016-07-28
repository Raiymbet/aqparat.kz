<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Admin;
use App\Repositories\AdminRepository;
use App\Repositories\NewRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    protected $new_repository;
    protected $post_repository;
    protected $admin_repository;

    public function __construct(NewRepository $newRepository, PostRepository $postRepository, AdminRepository $adminRepository)
    {
        $this->new_repository = $newRepository;
        $this->post_repository = $postRepository;
        $this->admin_repository = $adminRepository;
    }

    public function getHome()
    {
        $main_news = $this->new_repository->getMainNews();
        $slider_news = $this->new_repository->getSliderNews();

        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        $columnists = $this->admin_repository->getColumnists();

        return view('home', [
            'categories' => \App\Category::all(),
            'main_news' => $main_news,
            'slider_news' => $slider_news,
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
            'columnists' => $columnists
        ]);
    }

    public function getAbout()
    {
        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        $columnists = $this->admin_repository->getColumnists();
        return view('aboutus', [
            'categories' => \App\Category::all(),
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
            'columnists' => $columnists
        ]);
    }

    public function getColumnist($id)
    {
        $last_news = $this->new_repository->getLastNews();
        $last_posts = $this->post_repository->getLastPosts();
        $more_readed_news = $this->new_repository->getMoreReadedNews();
        $columnist = \App\Admin::find($id);
        $columnists = $this->admin_repository->getColumnists();
        return view('columnist', [
            'categories' => \App\Category::all(),
            'last_news' => $last_news,
            'last_posts' => $last_posts,
            'more_readed_news' => $more_readed_news,
            'columnist' => $columnist,
            'columnists' => $columnists
        ]);
    }
}
