<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\kelas;
use App\Models\gender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class authController extends Controller
{
    //

    public function loginForm(){
        return view('Auth.login', [
            'kelas' => kelas::all()
        ]);
    }

    public function registerForm(){
        return view('Auth.register', [
            'kelas' => kelas::all(),
            'gender'=> gender::all()
        ]);
    }

    public function login(Request $request){
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            User::where('id', Auth()->User()->id)
                ->update([
                    'status'    => 1
                ]);

            if(Auth()->User()->id_role == 1){
                return redirect()->intended('/dashboard');
            }elseif(Auth()->User()->id_role == 2){
                return redirect()->intended('/dashboard');
            }else{
                return back()->with([
                    'error' => 'Who The Hell are u?',
                ]);
            }
        }
 
        return back()->with([
            'error' => 'Plese enter the correct username or password',
        ]);
        
    }

    public function register(Request $request){
        // @dd($request->all());
        $credentials = $request->validate([
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:5'],
            'username' => ['required', 'min:3'],
            'nis'   => ['required', 'min:8', 'max:10', 'unique:users']
        ]);

        // $validate = User::Where('nis', $request->nis)->get();

        if($request->password !== $request->password2){
            return back()->with([
                'error' => 'Your password didnt same as your retype password',
            ]);
        }else{
            User::create([
                'username' => $request->username,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'nis'      => $request->nis,
                'id_role'  => 2,
                'id_kelas' => $request->kelas,
                'id_gender'=> $request->gender
            ]);

            return redirect('/')->with('succes', 'Sign Up succes');
        }
    }

    public function logout(Request $request){

        User::where('id', Auth()->User()->id)
                ->update([
                    'status'    => 0
                ]);
                
        
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
        }

        public function Request (){

            $apiKey = 'DEV-Z43CP26mVEPJRxbfLDooR7KhsGleaGgvpl4kdPCl';
            
            $payload = ['code' => ''];
            
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
              CURLOPT_FRESH_CONNECT  => true,
              CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel?'.http_build_query($payload),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HEADER         => false,
              CURLOPT_HTTPHEADER     => ['Authorization: Bearer '.$apiKey],
              CURLOPT_FAILONERROR    => false,
              CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
            ));
            
            $response = curl_exec($curl);
            $error = curl_error($curl);
            
            curl_close($curl);

            $response = json_decode($response)->data;
            
            $response ? $response : $error;
            
            // dd($response);
            
            return view('try', compact('response'));
            
            }
}
