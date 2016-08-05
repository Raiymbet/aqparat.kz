<?php
/**
 * Created by PhpStorm.
 * User: Raiymbet
 * Date: 09.07.2016
 * Time: 22:44
 */

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\User;
use Auth;
use Socialite;

class SocialiteController extends Controller{

    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getLoginUserForm()
    {
        return view('login');
    }
    public function getSocialiteAuth($provider=null)
    {
        if(!config("services.$provider")) abort('404');

        return Socialite::driver($provider)->redirect();
    }

    public function getSocialiteAuthCallback($provider=null)
    {
        if($social_user = Socialite::driver($provider)->user()){
            //dd($social_user);
            $authUser = $this->findOrCreateUser($social_user, $provider);
            Auth::login($authUser, true);
            return redirect()->to('/');
        }else{
            return 'Socialite Authentication is failed!';
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }

    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where('email', $user->email)->where('provider', $provider)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
            'provider' => $provider
        ]);
    }
}
