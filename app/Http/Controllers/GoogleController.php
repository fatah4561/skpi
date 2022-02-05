<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
  

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
        
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect('/');
       
            }else{
                $findEmail = User::where('email', $user->email)->first();
                // dd($findEmail);
                if($findEmail){
                    $findEmail->update([
                        'password' => encrypt($user->id),
                        'type' => '1',
                        'google_id'=> $user->id,
                    ]);
                    Auth::login($findEmail);
                    return redirect('/dashboard');

                }else{
                    return redirect('/login')->withErrors(['msg' => 'Anda tidak terdaftar']);
                }

                // $newUser = User::create([
                //     'name' => $user->name,
                //     'email' => $user->email,
                //     'password' => encrypt($user->id),
                //     'type' => '1',
                //     'google_id'=> $user->id,
                    
                // ]);
      

            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}