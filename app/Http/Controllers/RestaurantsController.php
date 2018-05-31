<?php

namespace App\Http\Controllers;

use App\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RestaurantsController extends Controller
{
    public function index(){
        $restaurant = Restaurant::all() -> toArray();
        return response()->json($restaurant);
    }
    public function store(Request $request){
        try{
            $restaurant = new Restaurant([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'kind_of_food' => $request->input('kind_of_food'),
                'rating' => $request->input('rating'),
                'image_path' => $request->input('image_path'),
                'opening_hours' => $request->input('opening_hours'),
                'description' => $request->input('description'),
                'phone' => $request->input('phone'),
                'latitude' => $request->input('latitude'),
                'longitude' => $request->input('longitude'),
                'capacity' => $request->input('capacity'),
                'id_admin' => $request->input('id_admin'),

            ]);
            $restaurant->save();

            return response()->json(['status'=>true,'Restaurant stored'],200);

        } catch (\Exception $e){
            return response('Something bad stroring a restaurant'.$e, 500);
        }
    }
    public function show($id){
        try{
            $restaurant = Restaurant::find($id);
            if(!$restaurant){
                return response()->json(['This restaurant id doesnt exist']);
            }

            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            Log::critical("Could not show restaurant: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $restaurant = Restaurant::find($id);
            if(!$restaurant){
                return response()->json(['This user id doesnt exist, and I cant update it']);
            }

            $restaurant -> name = $request -> name;
            $restaurant -> address = $request -> address;
            $restaurant -> kind_of_food = $request -> kind_of_food;
            $restaurant -> rating = $request -> rating;
            $restaurant -> image_path = $request -> image_path;
            $restaurant -> opening_hours = $request -> opening_hours;
            $restaurant -> description = $request -> description;
            $restaurant -> phone = $request -> phone;
            $restaurant -> latitude = $request -> latitude;
            $restaurant -> longitude = $request -> longitude;
            $restaurant -> capacity = $request -> capacity;
            $restaurant -> id_admin = $request -> id_admin;

            $restaurant->save();
            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $restaurant = Restaurant::find($id);
            if(!$restaurant){
                return response()->json(['This user id doesnt exist, and I cant delete it']);
            }
            $restaurant->delete();
            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            Log::info($restaurant);
            return response('Something bad in destroy'.$e, 500);
        }
    }

    public function updateImage($idRestaurant, Request $request){
        try{
            $restaurant = Restaurant::find($idRestaurant);
            if(!$restaurant){
                return response()->json(['This restaurant id doesnt exist']);
            }

            $restaurant -> image_path = $request -> image_path;

            $restaurant->save();

            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            return response('Imagen no actualizada'.$e, 500);
        }
    }

    public function updateRating($idRestaurant, $rating){
        try{
            $restaurant = Restaurant::find($idRestaurant);
            if(!$restaurant){
                return response()->json(['This restaurant id doesnt exist']);
            }

            $restaurant -> rating = $rating;

            $restaurant->save();

            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            return response('Rating no actualizado'.$e, 500);
        }
    }

    public function updateIdAdmin($idRestaurant, $idAdmin){
        try{
            $restaurant = Restaurant::find($idRestaurant);
            if(!$restaurant){
                return response()->json(['This restaurant id doesnt exist']);
            }

            $restaurant -> id_admin = $idAdmin;
            $restaurant->save();

            return response()->json($restaurant, 200);

        }catch (\Exception $e){
            return response('id de admin no actualizado'.$e, 500);
        }
    }


}
