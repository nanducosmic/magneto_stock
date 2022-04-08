<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
         
    }

    /**
     * Create a new user instance after a valid registra tion.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(Request $request)
    {
        $fields=$request->validate([
            'name'      =>'required|string',
            'email'     =>'required|string|unique:users,email',
            'password'  =>'required|string|confirmed '
        ]);

        $user=User::create([
            'name'          =>$request['name'],
            'email'         =>$request['email'],
            'password'      =>bcrypt($request['password'])
               
        ]);

        $token = $user->createToken('myapptoken')->accessToken;

        $response =[
            'user' =>$user,
            'token'=>$token
        ];

        return response($response ,201);
    }

    public function logout(){
        
        return 'sdssd';
        // auth()->user()->tokens()->delete();

        // return[
        //     'message' =>'Logged Out'
        // ];
    }
    public function login(Request $request)
    {
        $fields=$request->validate([
          
            'email'     =>'required|string',
            'password'  =>'required|string'
        ]);

        // //Check Email
        // $user=User::where('email',$request['email'])->first();
        // //Check  Password
        // if(!$user || !Hash::check($request['password'],$user->password) ){
        //     return response([
        //         'message'=>'Bad creds'

        //     ]);
        // }
        $data = [
            'email' => request('email'),
            'password' => request('password')
        ];
        if(auth('web')->attempt($data)){
            $token = auth('web')->user()->createToken('test')->plainTextToken;
            return response($token ,201);
        }

        $response =[
            'user' =>$user,
            'token'=>$token
        ];

        return response($response ,201);
    }


}
