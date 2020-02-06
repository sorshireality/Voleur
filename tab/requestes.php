<?php

function create_request($client_id,$client_secret,$code,$return_url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.donationalerts.com/oauth/token");
    $post = 'grant_type='.'authorization_code&'.
        'client_id='.$client_id.'&client_secret='.$client_secret.'&redirect_uri='.$return_url.'&code='.$code;
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/x-www-form-urlencoded",
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response,true);
}

if (isset($_GET['code'])){
    $return_url = 'http://voleur.kl.com.ua/Voleur/tab/requestes.php';
    $token = create_request(402,'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T',$_GET['code'],$return_url)['access_token'];
    get_donats($token);
}
function get_access_token(){

}
function get_accaunt_info($user_token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.donationalerts.com/api/v1/user/oauth?scope=oauth-user-show");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer ".$user_token,
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response); exit;
}
function get_donats($user_token){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"https://www.donationalerts.com/api/v1/alerts/donations?scope=oauth-donation-index");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer ".$user_token,
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $response = json_decode($response);
    print_r($response->data[0]->username);
    exit;
}
?>