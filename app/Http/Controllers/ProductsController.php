<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all() -> toArray();
        return response()->json($product);
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
            $product = new Product([
                'name' => $request->input('name'),
                'id_restaurant' => $request->input('id_restaurant'),
                'price' => $request->input('price'),
                'amount' => $request->input('amount'),
                'description' => $request->input('description'),
                'category'=>$request->input('category'),
            ]);
            Log::info($product);
            $product->save();
            return response()->json(['status'=>true,'Product stored'],200);
        } catch (\Exception $e){
            return response($e, 500);
        }
    }

    public function show($id){
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json(['This opinion id doesnt exist']);
            }

            return response()->json($product, 200);

        }catch (\Exception $e){
            Log::critical("Could not show opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json(['This opinion id doesnt exist, and I cant update it']);
            }

            $product -> name = $request -> name;
            $product -> id_restaurant = $request -> id_restaurant;
            $product -> price = $request -> price;
            $product -> amount = $request -> amount;
            $product -> description = $request -> description;
            $product -> category = $request -> category;
            $product->save();
            return response()->json($product, 200);

        }catch (\Exception $e){
            Log::critical("Could not update opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $product = Product::find($id);
            if(!$product){
                return response()->json(['This opinion id doesnt exist, and I cant delete it']);
            }
            $product->delete();
            return response()->json($product, 200);

        }catch (\Exception $e){
            Log::critical("Could not delete opinion: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in destroy'.$e, 500);
        }
    }

    public function updateProductCategory($idProduct, Request $request){
        try{
            $product = Product::find($idProduct);
            if(!$product){
                return response()->json(['This restaurant id doesnt exist, and I cant delete it']);
            }

            $product -> category = $request -> category;

            $product->save();

            return response()->json($product, 200);

        }catch (\Exception $e){
            return response('Categoria no actualizada'.$e, 500);
        }
    }

    public function getProductsOfRestaurant($idRestaurant){
        try{
            $products = Product::all() -> toArray();
            if(!$products){
                return response()->json(['Error en la peticion de productos del restaurante' . $idRestaurant]);
            }
            $result = [];
            foreach($products as $product){
                if($product['id_restaurant'] == $idRestaurant){
                    $result[] = $product;
                }
            }

            return response()->json($result);

        }catch (\Exception $e){
            return response("error" .$e, 500);
        }
    }
}
