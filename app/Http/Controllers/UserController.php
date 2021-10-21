<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{           
   public function register(Request $request){
       $fields = $request->validate([
           'name'=>'required | string ',
           'email'=>'required | string | unique:users,email',
           'password' => 'required | string | confirmed ',
           'role' => 'required | string'
       ]);

        $user = User :: create([
        'name'=> $fields['name'],
        'email'=>$fields['email'],
        'role'=>$fields['role'],
        'password'=>bcrypt($fields['password'])

        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response =[
            'user'=>$user,
            'token' => $token
        ];


        return response($response,201);



   }
   public function login(Request $request){
       $fields = $request->validate([
          
           'email'=>'required | string ',
           'password' => 'required | string '
       ]);

       $user = User::where('email',$fields['email'])->first();
       if(!$user || !Hash::check($fields['password'],$user->password) ){
        return response([
            'message'=>'Bad credentials'
        ],401);
       }

        $token = $user->createToken('myapptoken')->plainTextToken;
        $response =[
            'user'=>$user,
            'token' => $token
        ];


        return response($response,201);



   }
   public function logout(Request $request){
 auth()->user()->tokens()->delete();
 return [
     'message'=>'logged out'
 ];
}



   // function register(Request $req){
    //     $user = new User();
    //     $user->name = $req->input('name');
    //     $user->email = $req->input('email');
    //     $user->password = Hash::make($req->input('password'));
    //     $user->save();
    //     return $user;
    // }

    // function login(Request $req){

    //     $user = User::where('email', $req->email)->first();
    //     if(!$user || !Hash::check($req->password,$user->password))
    //     {
    //         return response([
    //             "error" =>["email or password does not match."],
    //         ]);
    //     }
    //     return $user;
    // }
    function show($id){
         return User::find($id);
    }

  

   
}
