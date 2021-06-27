<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\User;

class AuthController extends Controller
{
  public function login(Request $request ){
      $email = $request->email;
      $password =$request->password;

      if(empty($email) OR empty($password))
      {
        return response()->json(['status' => 'error' , 'message'=> 'You must fill all fields']);
      }

      $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) 
        {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
    

    public function register(Request $request){
        $name=$request->name;
        $email=$request->email;
        $password=$request->password;

        if(empty($name) or empty($email) or empty($password)){
            return response()->json(['status' => 'error', 'message'=> 'You must fill all the fields']);

        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return response()->json(['status' => 'error', 'message'=> 'You must enter a valid email']);

        }
        if(strlen($password) < 6){
            return response()->json(['status' => 'error', 'message'=> 'Password should be minim 6 character']);
        }

        if(User::where('email', '=' , $email)->exists()){
            return response()->json(['status' => 'error', 'message'=> 'User already exists with this email']);
        }



        try{
            $user = new User();
            $user->name= $name;
            $user->email = $email;
            $user->password = app('hash')->make($password);

            if($user->save()){
                return $this->login($request);
            }
        } catch(Exception $e){
            return response()->json(['status' => 'error', 'message'=> $e->getMessage()]);
        }

    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

  
}
