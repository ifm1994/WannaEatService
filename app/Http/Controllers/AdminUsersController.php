<?php

namespace App\Http\Controllers;

use App\AdminUser;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(){
        $admin_users = AdminUser::all() -> toArray();
        return response()->json($admin_users);
    }
    public function store(Request $request){
        try{
            $admin_user = new AdminUser([
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'ftoken' => $request->input('ftoken'),
                'hasRestaurant' => false,
            ]);
            $admin_user->save();
            return response()->json(['status'=>true,'Admin user stored'],200);
        } catch (\Exception $e){
            return response('Something bad in store admin user'.$e, 500);
        }
    }
    public function show($id){
        try{
            $admin_user = AdminUser::find($id);
            if(!$admin_user){
                return response()->json(['This admin user id doesnt exist']);
            }

            return response()->json($admin_user, 200);

        }catch (\Exception $e){
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $admin_user = AdminUser::find($id);
            if(!$admin_user){
                return response()->json(['This admin user id doesnt exist, and I cant update it']);
            }

            $admin_user -> email = $request -> email;
            $admin_user -> password = $request -> password;
            $admin_user -> hasRestaurant = $request -> hasRestaurant;

            $admin_user->save();
            return response()->json($admin_user, 200);

        }catch (\Exception $e){
            return response('Something bad update'.$e, 500);
        }
    }


    public function destroy($id){
        try{
            $admin_user = AdminUser::find($id);
            if(!$admin_user){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }
            $admin_user->delete();

            return response()->json($admin_user, 200);

        }catch (\Exception $e){
            return response('Something bad destroy user' . $e, 500);
        }
    }

    public function getAdminIfExists($email, $password){
        $admins = AdminUser::all() -> toArray();

        foreach($admins as $admin){
            if($admin['email'] == $email && password_verify($password, $admin['password'])){
                return response()->json($admin, 200);
            }
        }
        return response()->json(['Este admin no existe, porque no se encuentra en la base de datos']);
    }

    public function updateUserToken($idUser, $token){
        $user = AdminUser::find($idUser);
        if(!$user){
            return response('El usuario no se encuentra'.$e, 500);
        }

        $user -> ftoken = $token;

        $user->save();

        return response()->json($user, 200);
    }

    public function getUserOfThisEmail($email){
        $admins = AdminUser::all() -> toArray();
        foreach($admins as $admin){
            if($admin['email'] == $email){
                return response()->json($admin, 200);
            }
        }
        return response()->json(['Este usuario no existe ']);
    }

}
