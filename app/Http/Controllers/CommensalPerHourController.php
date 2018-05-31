<?php

namespace App\Http\Controllers;

use App\CommensalPerHour;
use Illuminate\Http\Request;

class CommensalPerHourController extends Controller
{

    public function index()
    {
        $capacity = CommensalPerHour::all() -> toArray();
        return response()->json($capacity);
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
            $capacity = new CommensalPerHour([
                'id_restaurant' => $request->input('id_restaurant'),
                'hour' => $request->input('hour'),
                'commensal_capacity' => $request->input('commensal_capacity'),
            ]);
            $capacity->save();
            return response()->json(['status'=>true,'CommensalPerHour stored'],200);
        } catch (\Exception $e){
            Log::critical("Could not store commensal per hour: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad storing a commensal per hour'.$e, 500);
        }
    }

    public function show($id){
        try{
            $capacity = CommensalPerHour::find($id);
            if(!$capacity){
                return response()->json(['This commensal per hour id doesnt exist']);
            }

            return response()->json($capacity, 200);

        }catch (\Exception $e){
            Log::critical("Could not store commensal per hour: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $capacity = CommensalPerHour::find($id);
            if(!$capacity){
                return response()->json(['This commensal per hour id doesnt exist, and I cant update it']);
            }

            $capacity -> id_restaurant = $request -> id_restaurant;
            $capacity -> hour = $request -> hour;
            $capacity -> commensal_capacity = $request -> commensal_capacity;
            $capacity->save();
            return response()->json($capacity, 200);

        }catch (\Exception $e){
            Log::critical("Could not update commensal per hour: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $capacity = CommensalPerHour::find($id);
            if(!$capacity){
                return response()->json(['This commensal per hour id doesnt exist, and I cant delete it']);
            }
            $capacity->delete();
            return response()->json($capacity, 200);

        }catch (\Exception $e){
            Log::critical("Could not delete commensal per hour: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in destroy'.$e, 500);
        }
    }
    public function getCapacityPerHourOfRestaurant($idRestaurant){
        try{
            $capacities = CommensalPerHour::all() -> toArray();
            if (!$capacities){
                return response()->json(['Error en la peticion de capcacidades del restaurante' . $idRestaurant]);
            }
            $result = [];
            foreach($capacities as $capacity){
                if($capacity['id_restaurant'] == $idRestaurant){
                    $result[] = $capacity;
                }
            }
            return response() -> json($result);

        }catch(\Exception $e){
            return response("error" .$e, 500);
        }
    }
}
