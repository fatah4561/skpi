<?php

namespace App\Http\Controllers;

use App\Models\Student;
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
                // update foto pada student
                $student = Student::where('user_id', $finduser->id)->first();
                $student->update([
                    'picture'=> $user->getAvatar(),
                ]);
                Auth::login($finduser);
                return redirect('/');
       
            }else{
                $findEmail = User::where('email', $user->email)->first();
                
                if($findEmail->type == 1){
                    dd('test');
                    // updaate google id dan password pada akun mahasiswa
                    $findEmail->update([
                        'password' => encrypt($user->id),
                        'type' => '1',
                        'google_id'=> $user->id,
                    ]);
                    // update foto pada student
                    $student = Student::where('user_id', $findEmail->id)->first();
                    $student->update([
                        'picture'=> $user->getAvatar(),
                    ]);
                    Auth::login($findEmail);
                    return redirect('/dashboard');

                }elseif($findEmail->type == 0){
                    Auth::login($findEmail);
                    return redirect('/index');
                }else{
                    return redirect('/login')->withErrors(['msg' => 'Anda tidak terdaftar']);
                }      

            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}