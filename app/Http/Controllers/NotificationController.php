<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

use App\Http\Requests;

class NotificationController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function readNotifications(Request $request){
        $array = $request->input('array');
        $notifications = Notification::findMany($array);
        foreach($notifications as $notification){
            $notification->is_read = true;
            $notification->save();
        }
        return 'success';
    }
}
