<?php


class Helper
{
    const BASE_SERVER_NAME = 'localhost:3306';

    public static function connect_db($base_log, $base_pass)
    {
        $conn = new PDO("mysql:host=localhost;dbname=id12607894_hidden_home", $base_log, $base_pass);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
}



    public static function get($url,$token){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer ".$token,
        ]);
        $response = json_decode(curl_exec($ch),true);
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
        array_push($response,$status_code);
        return $response;
    }
    public static function post($url,$client_id,$client_secret,$redirect_uri,$code){
        $ch = curl_init ($url);
        $data = array(
            'grant_type' => 'authorization_code',
            'client_id' => (string)$client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'code' => $code
        );
        curl_setopt($ch, CURLOPT_COOKIEJAR, '-');
        curl_setopt ($ch, CURLOPT_POST, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $returndata = curl_exec($ch);
        $response = json_decode($returndata,true);
        $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
        array_push($response,$status_code);
        curl_close($ch);
        return $response;
    }
}