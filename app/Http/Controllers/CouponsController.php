<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CouponsController extends Controller
{
    public function index()
    {
        $coupon = Coupon::all() -> toArray();
        return response()->json($coupon);
    }

    public function store(Request $request)
    {
        try{
            $coupon = new Coupon([
                'description'=>$request->input('description'),
                'id_restaurant' => $request->input('id_restaurant'),
                'id_user' => $request->input('id_user'),
                'category' => $request->input('category'),
                'discount' => $request->input('discount'),
                'code' => $request->input('code'),
            ]);
            $coupon->save();
            return response()->json(['status'=>true,'Coupon stored'],200);
        } catch (\Exception $e){
            return response('Something bad storing a coupon'.$e, 500);
        }
    }

    public function show($id){
        try{
            $coupon = Coupon::find($id);
            if(!$coupon){
                return response()->json(['This coupon id doesnt exist']);
            }

            return response()->json($coupon, 200);

        }catch (\Exception $e){
            Log::critical("Could not show coupon: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $coupon = Coupon::find($id);
            if(!$coupon){
                return response()->json(['This coupon id doesnt exist, and I cant update it']);
            }

            $coupon -> description = $request -> description;
            $coupon -> id_restaurant = $request -> id_restaurant;
            $coupon -> id_user = $request -> id_user;
            $coupon -> category = $request -> category;
            $coupon -> discount = $request -> discount;
            $coupon -> code = $request -> code;
            $coupon->save();
            return response()->json($coupon, 200);

        }catch (\Exception $e){
            Log::critical("Could not update coupon: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $coupon = Coupon::find($id);
            if(!$coupon){
                return response()->json(['This coupon id doesnt exist, and I cant delete it']);
            }
            $coupon->delete();
            return response()->json($coupon, 200);

        }catch (\Exception $e){
            Log::critical("Could not delete coupon: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in destroy'.$e, 500);
        }
    }

    public function getCouponsOfUser($idUser){
        try{
            $coupons = Coupon::all() -> toArray();
            if(!$coupons){
                return response()->json(['Error en la peticion de cupones de un usuario' . $idUser]);
            }
            $result = [];
            foreach($coupons as $coupon){
                if($coupon['id_user'] == $idUser){
                    $result[] = $coupon;
                }
            }

            return response()->json($result);

        }catch(\Exception $e){
            return response("error" .$e, 500);
        }
    }

}
