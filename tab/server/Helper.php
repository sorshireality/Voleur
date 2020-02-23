<?php


class Helper
{

    public static function connect_db($base_log, $base_pass)
    {
        $conn = new PDO("mysql:host=localhost;dbname=id12607894_hidden_home", $base_log, $base_pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}
    public static function insert_token(PDO $connect, array $values, $user_code){
        $sql = "INSERT INTO tokens (access_token, expired, refresh_token, user_code) VALUES (?,?,?,?)";
        $stmt= $connect->prepare($sql);
        $stmt->execute([$values['access_token'],$values['expires_in'],$values['refresh_token'],$user_code]);
    }
    public static function get_token(PDO $connect, $user_code){
        $stmt = $connect->query("SELECT * FROM tokens WHERE user_code = '".$user_code."'");
        $temp = $stmt->fetchAll();
        $new_token = self::refresh_token($temp[0]['refresh_token']);
        $stmt = $connect->query("UPDATE tokens SET access_token='".$new_token['access_token']."', expired='".$new_token['expires_in']."', refresh_token='".$new_token['refresh_token']."' WHERE user_code = '".$user_code."'");
        $stmt->execute();
        return $new_token;
    }
    public static function close_connection(PDO $connect){
        return $connect = null;
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
    public static function post($url,$grant_type,$client_id,$client_secret,$redirect_uri,$code,$scope = null,$refresh_token = null){
        $ch = curl_init ($url);
        $data = array(
                'grant_type' => $grant_type,
            'refresh_token' => $refresh_token,
            'client_id' => (string)$client_id,
            'client_secret' => $client_secret,
            'scope' => $scope,
            'redirect_uri' => $redirect_uri,
            'code' => $code
        );
        curl_setopt($ch, CURLOPT_COOKIEJAR, '-');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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
    public static function getcode($code){
            $result = Helper::post('https://www.donationalerts.com/oauth/token','authorization_code',402,'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T','https://voleur.000webhostapp.com/tab/server/processor.php',$code);
            if ($result[0] == 200) {
                $temp = self::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');
                self::insert_token($temp,$result,'test_code');
                self::close_connection($temp);
                ?><script> window.close();</script><?php
            } else {
                echo "Error while get aceess code : message -> ";
                print_r($result);
                exit;
            }

    }
    public static function get_donations($token) {
        $url = 'https://www.donationalerts.com/api/v1/alerts/donations';
        $response = Helper::get($url,$token);
        if ($response[0] == 200){
            return $response;
        } else exit;
    }
    public static function refresh_token($refresher){
        $redirect = null;
        $id = 402;
        $secret = 'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T';
        $code = null;
        $scope = 'oauth-donation-index';
        $refresh_token = $refresher;
        $url = 'https://www.donationalerts.com/oauth/token';
        $result = self::post($url,'refresh_token',$id,$secret,$redirect,$code,$scope,$refresh_token);
        return $result;
    }
}
?>