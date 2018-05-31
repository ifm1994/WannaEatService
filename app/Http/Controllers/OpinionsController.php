<?php

namespace App\Http\Controllers;

use App\Opinion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OpinionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opinion = Opinion::all() -> toArray();
        return response()->json($opinion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $opinion = new Opinion([
                'name' => $request->input('name'),
                'rating' => $request->input('rating'),
                'description' => $request->input('description'),
                'id_user' => $request->input('id_user'),
                'id_restaurant' => $request->input('id_restaurant'),
            ]);
            $opinion->save();
            return response()->json(['status'=>true,'Opinion stored'],200);
        } catch (\Exception $e){
            Log::critical("Could not store opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad storing a opinion'.$e, 500);
        }
    }

    public function show($id){
        try{
            $opinion = Opinion::find($id);
            if(!$opinion){
                return response()->json(['This opinion id doesnt exist']);
            }

            return response()->json($opinion, 200);

        }catch (\Exception $e){
            Log::critical("Could not show opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $opinion = Opinion::find($id);
            if(!$opinion){
                return response()->json(['This opinion id doesnt exist, and I cant update it']);
            }

            $opinion -> name = $request -> name;
            $opinion -> rating = $request -> rating;
            $opinion -> description = $request -> description;
            $opinion -> id_user = $request -> id_user;
            $opinion -> id_restaurant = $request -> id_restaurant;
            $opinion->save();
            return response()->json($opinion, 200);

        }catch (\Exception $e){
            Log::critical("Could not update opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $opinion = Opinion::find($id);
            if(!$opinion){
                return response()->json(['This opinion id doesnt exist, and I cant delete it']);
            }
            $opinion->delete();
            return response()->json($opinion, 200);

        }catch (\Exception $e){
            Log::critical("Could not delete opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in destroy'.$e, 500);
        }
    }

    public function getOpinionsOfRestaurant($idRestaurant){
        try{
            $opinions = Opinion::all() -> toArray();
            if (!$opinions){
                return response()->json(['Error en la peticion de opiniones del restaurante' . $idRestaurant]);
            }
            $result = [];
            foreach($opinions as $opinion){
                if($opinion['id_restaurant'] == $idRestaurant){
                    $result[] = $opinion;
                }
            }
            return response() -> json($result);

        }catch(\Exception $e){
            return response("error" .$e, 500);
        }
    }
}
