<?php


class Helper
{
    public static function get($url,$token){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer ".$token,
        ]);
        $response = curl_exec($ch);
        return json_decode($response);
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