<?php
namespace App\Helpers;

class ApiHelper{
    static function get_api_token(){
        //get jwt token
        $url = base_url("/api/auth/login");
        // $url = ("https://wgg.petra.ac.id/api/auth/login");
        $body = [
            "email" => "it.wgg.petra@gmail.com",
            "password" => getenv("password_api")
        ];
    
        $ch = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $body,
        ];
        curl_setopt_array($ch, $options);
    
        $response = curl_exec($ch);
    
        $response =  json_decode($response, true);
    
        curl_close($ch);
    
        return $response['access_token'];
    }

}