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
            CURLOPT_USERAGENT => 'Authorization: Bearer <token>'
        ]);
    }

    public function send_request(){
        if (!curl_exec($this->curl)) {
            die('Error: "' . curl_error($this->curl) . '" - Code: ' . curl_errno($this->curl));
        } else {
        $response = curl_exec($this->curl);
        curl_close($this->curl);
        return $response;
        }
    }
    const ENDPOINT = "https://www.donationalerts.com/api/v1";

}

?>