<?php
namespace plug;

class Voleur
{
    private $version = "1.0.0";
    private $curl;
    function __construct() {
        $this->curl = curl_init();
        $this->setup_cUrl();
    }

    private function setup_cUrl()
    {
        curl_setopt_array($this->curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => self::ENDPOINT,
        ]);
    }

    public function send_request(){
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.self::TOKEN));
        if (!curl_exec($this->curl)) {
            die('Error: "' . curl_error($this->curl) . '" - Code: ' . curl_errno($this->curl));
        } else {
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return $response;
        }
    }
    const TOKEN = "JpXlwd0NGIBWeUGuJr1x";
    const GET_ENDPOINT = "https://www.donationalerts.com/oauth/authorize";
    const ENDPOINT = "https://www.donationalerts.com/api/v1/alerts/donations";

}

?>