<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use Google_Client;

class LoginGames extends BaseController
{
    protected $googleClient;
    protected $security;
    public function __construct()
    {
        $security = \Config\Services::security();
        $this->googleClient = new Google_Client();
        
        $this->googleClient->setClientId("422658755343-sitjrg8qkcie4pcdd0htihnrqucjrml3.apps.googleusercontent.com");
        $this->googleClient->setClientSecret("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");
        $this->googleClient->setRedirectUri(site_url("/auth"));
        $this->googleClient->addScope("email");
        $this->googleClient->addScope("profile");
        
    }
    public function index()
    {
        //kalo sudah ada sessionnya redirect lagi ke halaman utama
        if(!(session()->get('email') === null || session()->get('nama') === null || session()->get('nrp') === null)){
            return redirect()->to("/games");
        }

        $data['link'] = $this->googleClient->createAuthUrl();
        
        //kalo belum ada sessionnya tampilin page login nya 
        //ini masih pake yang lama jadi bisa diganti view pake yang punya games
        return view('rally/login', $data);
    }

    public function redirect($msg)  
    {
        return redirect()->to("/games/login")->with('error', $msg);
    }

    public function login()
    {
        //pake cara HTML API Google baru
    
        if ($this->request->getVar('g_csrf_token') != null) {
            // valid CSRF token
            // Handle the error here

            \Firebase\JWT\JWT::$leeway = 60;

            do {
                $attempt = 0;
                try {
                    //get the cretential from post sent by google
                    $id_token = $this->request->getVar('credential');

                    //verify the idtoken to convert to the data
                    $payload = $this->googleClient->verifyIdToken($id_token);
            
                    if ($payload) {
                        // dd($payload);

                        //check petra mail
                        if(isset($payload['hd']) && $payload['hd'] == "john.petra.ac.id"){
                            //set session  
                            
                            //with ajax
                            echo $this->ajaxRequest(substr($payload['email'], 0, 9));
                            return;

                        }else{
                            return redirect()->back()->with('error', "Please Use Your @john.petra.ac.id email");
                        }
                        
                        
                    } else {
                        // Invalid ID token
                    }
                    
                    $retry = false;
                    
                } catch (\Firebase\JWT\BeforeValidException $e) {
                    $attempt++;
                    $retry = $attempt < 2;
                }
            } while ($retry);
            
        } else {
            return redirect()->back()->with('error', "Error CSRF");
        }
        return redirect()->back()->with('error', "Something Went Wrong");
    }

    public function getToken(){
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

    public function logout(){
        session()->destroy();
        return redirect()->to("/games/login")->with('error', "You Are Logged Out");

    }

    public function ajaxRequest($nrp)
    {
        return '
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script>
        //$(document).ready(function(){
            $.ajax({
                url: "'. base_url("api/2023/login/$nrp") .'",
                method: "POST",
                contentType: "application/json", 
                headers: {
                    "Authorization": "Bearer '. $this->getToken() .'"
                },
                complete: function(xhr, result){
                    msg = xhr.responseJSON.message;

                    window.location.replace("'. site_url("games/login/") .'" + msg);
                }
            });
        //});
        </script>
        ';
    }

}

