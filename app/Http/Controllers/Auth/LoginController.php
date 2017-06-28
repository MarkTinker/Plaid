<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        try {
            $socialUser = Socialite::driver('facebook')->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        
        
        $user = User::where('facebook_id', $socialUser->getId())->first();
        // $user->token;
        
        if(!$user)
        {

            $fullname = $socialUser->getName();

            // Divide into first name and last name
            $fullname = trim($fullname);
            $lname = (strpos($fullname, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $fullname);
            $fname = trim( preg_replace('#'.$lname.'#', '', $fullname ) );
            
            $info = [];
            $info['facebook_id'] = $socialUser->getId();
            $info['fname'] = $fname;
            $info['lname'] = $lname;
            $info['email'] = $socialUser->getEmail();
            
            return view('auth.profile')->withInfo($info);
        }
        
        auth()->login($user);
        return redirect(Route('pages.dashboard'));
    }
}
