<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{
    public function index(){
        $users = User::all() -> toArray();
        return response()->json($users);
    }
    public function store(Request $request){
        try{
            $user = new User([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'phone' => $request->input('phone'),
            ]);
            $user->save();
            return response()->json(['status'=>true,'User stored'],200);
        } catch (\Exception $e){
            Log::critical("Could not store user: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in store'.$e, 500);
        }
    }
    public function show($id){
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['This user id doesnt exist']);
            }

            return response()->json($user, 200);

        }catch (\Exception $e){
            Log::critical("Could not show user: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['This user id doesnt exist, and I cant update it']);
            }

            $user -> name = $request -> name;
            $user -> email = $request -> email;
            $user -> password = $request -> password;
            $user -> phone = $request -> phone;
            $user->save();
            return response()->json($user, 200);

        }catch (\Exception $e){
            Log::critical("Could not update user: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }


    public function destroy($id){
        try{
            $user = User::find($id);
            if(!$user){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }
            $user->delete();
//            User::destroy($id);
            return response()->json($user, 200);

        }catch (\Exception $e){
            return response('Something bad destroy user' . $e, 500);
        }
    }


    public function getUserIfExists($email, $password){
        $users = User::all() -> toArray();

        foreach($users as $user){
            if($user['email'] == $email && password_verify($password, $user['password'])){
                return response()->json($user, 200);
            }
        }
        return response()->json(['Este usuario no existe, porque no se encuentra en la base de datos']);
    }

    public function getUserOfThisEmail($email){
        $users = User::all() -> toArray();
        foreach($users as $user){
            if($user['email'] == $email){
                return response()->json($user, 200);
            }
        }
        return response()->json(['Este usuario no existe '.$email]);
    }

    public function updateUserInfo($idUser, Request $request){
        try{
            $user = User::find($idUser);
            if(!$user){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }

            $user -> name = $request -> name;
            $user -> email = $request -> email;
            $user -> phone = $request -> phone;

            $user->save();

            return response()->json($user, 200);

        }catch (\Exception $e){
            return response('Usuario no actualizado'.$e, 500);
        }
    }

    public function updateUserPassword($idUser, $oldPassword, $newPassword){
        $user = User::find($idUser);
        if(!$user){
            return response('El usuario no se encuentra', 500);
        }

        if( password_verify($oldPassword, $user['password'])){
            $user -> password =  bcrypt($newPassword);
            $user->save();
            return response('Contraseña cambiada', 200);
        }else{
            return response('La contraseña no coincide', 500);
        }
    }

    public function updateUserToken($idUser, $token){
        $user = User::find($idUser);
        if(!$user){
            return response('El usuario no se encuentra', 500);
        }

        $user -> ftoken = $token;

        $user->save();

        return response()->json($user, 200);
    }

}
