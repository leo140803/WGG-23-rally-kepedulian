<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Session\Session;
use Exception;
use Google_Client;

class Login extends BaseController
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
        if(!(session()->get('email') === null || session()->get('nama') === null || session()->get('nrp') === null)){
            return redirect()->to("/panitia");
        }

        $data['link'] = $this->googleClient->createAuthUrl();
        // session()->setFlashdata('error', "ini ada error");
        return view('login/login', $data);
    }

    public function redirect($msg)  
    {
        return redirect()->to("/login")->with('error', $msg);
    }
    
    public function login2()
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

                            //with curl
                            $result = $this->setLoginSession($payload['email'], $payload['name']);

                            //successs
                            if($result == null){
                                return redirect()->to("/home")->withCookies();
                            }
                            
                            return $result;

                        }else{
                            return redirect()->to("/login")->with('error', "Please Use Your @john.petra.ac.id email");
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
            return redirect()->to("/login")->with('error', "Error CSRF");
        }
          
    }


    private function setLoginSession($email, $nama){
        //manual
        // session()->set('email', $email);
        // session()->set('nama', $nama);
        // session()->set('nrp', substr($email, 0, 9));

        //with api
        try{
            $result = $this->apiLogin(substr($email, 0, 9));

            if($result['code'] != 200){
                return redirect()->to('/login')->with('error', $result['message']);
            }
        }catch(Exception $e){
            return redirect()->to('/login')->with('error', 'Something Went Wrong');
        }
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

    public function apiLogin($nrp){

        $token = $this->getToken();
        
        //login
        $url = base_url("api/2023/login/$nrp");
        // $url = "https://wgg.petra.ac.id/api/2023/login/$nrp";
        $header = ["Content-Type: application/json", "Authorization: Bearer $token"];

        $ch = curl_init();
        $options = [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $header,
        ];
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);

        $response =  json_decode($response, true);
        
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $response['code'] = $httpcode;

        // d($token);
        // d($response);
        // var_dump(curl_errno($ch));
        
        //if success
        if($httpcode == 200){
            //set cookie
            // d("masuk set coockie");

            $this->response->setcookie(
                getenv('app.sessionCookieName'), 
                $response['sessionCookie'],
                getenv('app.sessionExpiration'));

        }

        // d($_SESSION);

        return $response;
    }
    public function logout(){
        //masih ada session ada session
        if(!(session()->get('email') === null || session()->get('nama') === null || session()->get('nrp') === null)){
            //destroy for wgg web
            session()->destroy();

            //destroy for admin app web
            return '
            <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
            <script>
            //$(document).ready(function(){
                $.ajax({
                    url: "https://wgg.petra.ac.id/app/admin/logout",
                    method: "GET",
                    contentType: "application/json", 
                    complete: function(xhr, result){
                        window.location.replace("'. site_url("logout") .'");
                    }
                });
            //});
            </script>
            ';
        }

        //if there is no session send message
        return redirect()->to("/login")->with('error', "You Are Logged Out");
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
                    window.location.replace("'. site_url("login/") .'" + msg);
                }
            });
        //});
        </script>
        ';
    }
    
    public function loginApp()
    {
        $nrp = $this->request->getVar('nrp');
        $token = $this->request->getVar('token');
        
        if(!isset($nrp) || !isset($token)){
            return view('layouts/base_layouts') . '
            <div class="d-flex justify-content-center align-items-center vh-100">
                <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            ';
        }

        return view('layouts/base_layouts') . '
        <div class="d-flex justify-content-center align-items-center vh-100">
            <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
        <script>
        //$(document).ready(function(){
            $.ajax({
                url: "'. base_url("api/2023/login/$nrp") .'",
                method: "POST",
                contentType: "application/json", 
                headers: {
                    "Authorization": "Bearer '. $token .'"
                },
                success: function(xhr, result){
                    window.location.replace("'. site_url("peserta/home") .'");
                },
                error: function(xhr, result){
                    $(".spinner-border").hide();
                    $(".spinner-border").parent().text("Error: Terjadi Kesalahan");
                }
            });
        //});
        </script>
        ';
    }

    public function hardLogin(){
        // return $this->testLogin();

        if(!str_contains(site_url(), "wgg.petra.ac.id")){
            
            session()->set('email', "c14200078@john.petra.ac.id");
            session()->set('nama', "ANTHONY REYNALDI");
            session()->set('nrp', "C14200078");
            session()->set('isPanitia', true);
            session()->set('divisi', "IT");

            return redirect()->to("/home")->withCookies();

        }else{
            return redirect()->to('/login')->with('error', 'ERROR');
        }
    }

    public function testLogin(){
        echo $this->ajaxRequest("c14200078");
        return;

        $result = $this->setLoginSession("c14200078@john.petra.ac.id", "anthony reynaldi");

        d(session()->session_id);
        d(session()->get());
        d(session()->session_id);
    
        d($result);
        //successs
        if($result == null){
            // return redirect()->to("/home")->withCookies();
        }
        
        return $result;
    }
}
