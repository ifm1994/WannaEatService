<?php

namespace App\Http\Controllers;

use App\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingsController extends Controller
{

    public function index()
    {
        $booking = Booking::all() -> toArray();
        return response()->json($booking);
    }

    public function store(Request $request)
    {
        try{
            $booking = new Booking([
                'id_restaurant' => $request->input('id_restaurant'),
                'id_user' => $request->input('id_user'),
                'time' => $request->input('time'),
                'price' => $request->input('price'),
                'id_transaction' => $request->input('id_transaction'),
                'products_and_amount'  => $request->input('products_and_amount'),
                'payment_method' => $request->input('payment_method'),
                'client_name' => $request->input('client_name'),
                'client_phone' => $request->input('client_phone'),
                'client_email' => $request->input('client_email'),
                'number_of_commensals' => $request->input('number_of_commensals'),
                'client_commentary' => $request->input('client_commentary'),
                'canrate' => $request->input('canrate'),
                'status' => $request->input('status'),
            ]);
            $booking->save();
            return response()->json(['status'=>true,'Booking stored'],200);
        } catch (\Exception $e){
            Log::critical("Could not store booking: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad storing a booking'.$e, 500);
        }
    }

    public function show($id){
        try{
            $booking = Booking::find($id);
            if(!$booking){
                return response()->json(['This restaurant id doesnt exist']);
            }

            return response()->json($booking, 200);

        }catch (\Exception $e){
            Log::critical("Could not show restaurant: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in show'.$e, 500);
        }
    }
    public function update($id, Request $request){
        try{
            $booking = Booking::find($id);
            if(!$booking){
                return response()->json(['This booking id doesnt exist, and I cant update it']);
            }

            $booking -> id_restaurant = $request -> id_restaurant;
            $booking -> id_user = $request -> id_user;
            $booking -> time = $request -> time;
            $booking -> price = $request -> price;
            $booking -> id_transaction = $request -> id_transaction;
            $booking -> products_and_amount = $request -> products_and_amount;
            $booking -> payment_method = $request -> payment_method;
            $booking -> client_name = $request -> client_name;
            $booking -> client_phone = $request -> client_phone;
            $booking -> client_email = $request -> client_email;
            $booking -> number_of_commensals = $request -> number_of_commensals;
            $booking -> client_commentary = $request -> client_commentary;
            $booking -> canrate = $request -> canrate;
            $booking -> status = $request -> status;

            $booking->save();
            return response()->json($booking, 200);

        }catch (\Exception $e){
            Log::critical("Could not update booking: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad update'.$e, 500);
        }
    }

    public function destroy($id){
        try{
            $booking = Booking::find($id);
            if(!$booking){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }
            $booking->delete();
            return response()->json($booking, 200);

        }catch (\Exception $e){
            Log::critical("Could not delete booking: {$e->getCode()}, {$e->getLine()},{$e->getMessage()}");
            return response('Something bad in destroy'.$e, 500);
        }
    }

    public function getBookingsOfUser($idUser){
        try{
            $bookings = Booking::all() -> toArray();
            if(!$bookings){
                return response()->json(['Este usuario no tiene reservas' . $idUser]);
            }
            $result = [];
            foreach($bookings as $booking){
                if($booking['id_user'] == $idUser){
                    $result[] = $booking;
                }
            }

            return response()->json($result);

        }catch(\Exception $e){
            return response("error" .$e, 500);
        }
    }

    public function getBookingsOfRestaurant($idRestaurant){
        try{
            $bookings = Booking::all() -> toArray();
            if(!$bookings){
                return response()->json(['Este restaurante no tiene reservas' . $idRestaurant]);
            }
            $result = [];
            foreach($bookings as $booking){
                if($booking['id_restaurant'] == $idRestaurant){
                    $result[] = $booking;
                }
            }

            return response()->json($result);

        }catch(\Exception $e){
            return response("error" .$e, 500);
        }
    }


    public function updateBookingStatus($idBooking, Request $request){
        try{
            $booking = Booking::find($idBooking);
            if(!$booking){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }

            $booking -> status = $request -> status;

            $booking->save();

            return response()->json($booking, 200);

        }catch (\Exception $e){
            return response('Categoria no actualizada', 500);
        }
    }

    public function updateBookingCanRateToTrue($idBooking){
        try{
            $booking = Booking::find($idBooking);
            if(!$booking){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }

            $booking -> canrate = true;

            $booking->save();

            return response()->json($booking, 200);

        }catch (\Exception $e){
            return response('Categoria no actualizada', 500);
        }
    }

    public function updateBookingCanRateToFalse($idBooking){
        try{
            $booking = Booking::find($idBooking);
            if(!$booking){
                return response()->json(['This booking id doesnt exist, and I cant delete it']);
            }

            $booking -> canrate = false;

            $booking->save();

            return response()->json($booking, 200);

        }catch (\Exception $e){
            return response('Categoria no actualizada', 500);
        }
    }

}
