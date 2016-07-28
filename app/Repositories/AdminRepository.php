<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 22.07.2016
 * Time: 2:34
 */

namespace App\Repositories;

use App\Admin;

class AdminRepository
{
    public function getColumnists()
    {
        return Admin::where('type', 'columnist')->orderBy('created_at', 'asc')->get();
    }
}