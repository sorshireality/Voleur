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
        return $stmt->fetchAll();
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
    public static function getcode($code){
            $result = Helper::post('https://www.donationalerts.com/oauth/token',402,'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T','https://voleur.000webhostapp.com/tab/server/processor.php',$code);
            if ($result[0] == 200) {
                $temp = self::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');
                self::insert_token($temp,$result,'test_code');
                self::close_connection($temp);
                ?><script> setTimeout(function() { window.location = "processor.php?token=<?php echo $result['access_token']; ?>"; }, 500); </script><?php
            } else {
                echo "Error while get aceess code : message -> ";
                print_r($result);
                exit;
            }

    }
    public static function gettoken($token) {
        $url = 'https://www.donationalerts.com/api/v1/alerts/donations';
        $response = Helper::get($url,$token);
        print_r($response);
        if ($response[0] == 200){
            ?>
            <script>window.close();</script>
            <?php
        }
    }
}