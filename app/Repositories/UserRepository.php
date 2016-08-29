<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 10.07.2016
 * Time: 13:46
 */

namespace App\Repositories;

use App\Comment;
use App\User;

class UserRepository
{

    public function getComments(User $user)
    {
        return Comment::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}