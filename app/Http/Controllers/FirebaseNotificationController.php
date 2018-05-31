<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirebaseNotificationController extends Controller
{
    public function createNotification(Request $request){
        ignore_user_abort();
        ob_start();

        $url = 'https://fcm.googleapis.com/fcm/send';

        $ReceiverToken = $request -> receiver_token;

        $fields = array(
            'to' => $ReceiverToken ,
            'notification' => array(
                'body' => $request -> body,
                'title' => $request -> title),

            'data' => array(
                'Objetos' => 'Mesa-silla-escritorio'
            )
        );

        define('GOOGLE_API_KEY', 'AIzaSyDnEFosDzgHkv2Zgzq6013AyRWZZP0dy30');

        $headers = array(
            'Authorization:key='.GOOGLE_API_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));

        $result = curl_exec($ch);
        if($result === false)
            die('Curl failed ' . curl_error());
        curl_close($ch);
        return $result;
    }
}
