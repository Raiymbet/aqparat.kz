<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 10.07.2016
 * Time: 23:51
 */

namespace App\Repositories;

use App\Admin;
use App\User;
use App\Post;

class PostRepository
{
    /**
     * Get all of the posts for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function getPosts(User $user)
    {
        return Post::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getPostById($id)
    {
        return Post::findOrFail($id);    
    }

    public function getAllPosts()
    {
        return Post::orderBy('created_at','desc')->get();
    }

    public function getLastPosts($count)
    {
        return Post::where('status', 'accepted')->whereNotNull('news_id')->orderBy('created_at', 'desc')->simplePaginate($count);
    }
}