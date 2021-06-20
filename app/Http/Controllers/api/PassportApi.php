<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Storage;
class PassportApi extends Controller
{
    public function register(){

        $validate = Validator::make(request()->all(),[
            'name'=>'required|min:1',
            'email'=>'required|min:3',
            'password'=>'required|min:6',
            'image'=>'mimes:jpb,png,jpeg'
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'failed',
                'data'=>$validate->errors()
            ]);
        }
        $name = request()->name;
        $email = request()->email;
        $password = request()->password;
        $image = request()->image;
        $filename = time() . '-' . $image->getClientOriginalName();
        $image->storeAs("/images",$filename);
        
        $user = User::create([
            'name'=>$name,
            'email'=>$email,
            'image'=>$filename,
            'password'=>bcrypt($password),
        ]);

        $token = $user->createToken('social')->accessToken;

        return response()->json([
            'status'=>200,
            'message'=>'success',
            'data'=>$user,
            'token'=>$token
        ]);


    }

    public function login(){
        $validate = Validator::make(request()->all(),[
            'email'=>'required|min:3',
            'password'=>'required|min:6',
        ]);

        if($validate->fails()){
            return response()->json([
                'status'=>500,
                'message'=>'failed',
                'data'=>$validate->errors()
            ]);
        }
        $email = request()->email;
        $password = request()->password;

        $credentail = ['email'=>$email,'password'=>$password];

        if(Auth::attempt(['email' => $email, 'password' => $password])){
            $user = Auth::user();
            $token = $user->createToken('social')->accessToken;
            return response()->json([
                'status'=>200,
                'message'=>'success',
                'data'=>$user,
                'token'=>$token
            ]);
        }
        return response()->json([
            'status'=>500,
            'message'=>'failed',
            'data'=>[
                'error'=>'Email and Password Does not match'
            ]
        ]);
    }
}
