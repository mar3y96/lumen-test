<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function register(Request $request)
    {
       $data = $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $data['password']= Hash::make($request->password);
         $user = User::create($data);
      
        /**Take note of this: Your user authentication access token is generated here **/
        $data['api_token'] =  str_random(60);
        $user->api_token=$data['api_token'];
        $user->save();
        

        return response()->json(['data' => $user, 'message' => 'Account created successfully!', 'status' => true]);
    }

    public function login(Request $request)
    {
       $data = $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user = User:: where("email", $data['email'])
                      
                      ->first();
        if ($user && Hash::check($data['password'], $user->password)) {
          $token=rand(100000000,100000000000);
          $user->api_token=$token;
          $user->save();
          return response()->json(['data' => $user, 'message' => 'login successfully!', 'status' => true]);

        } 
        else {
        return response()->json(['message' => 'auth error!', 'status' => false]);
        }
        
    }
}
