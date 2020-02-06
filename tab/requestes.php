<?php

$url = 'https://www.donationalerts.com/oauth/authorize?
    response_type=code&
    client_id=402&
    redirect_uri=http://voleur.testing.com/tab/requestes.php&
    scope=';
echo "<a href='.$url.'>Redirect</a>";
?>

<?php

if ($_GET){
    $response = $_GET;
    print_r($response);


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,"https://www.donationalerts.com/oauth/token");
    $post = 'grant_type='.'authorization_code&'.
    'client_id='.'402&'.'client_secret='.'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T&'.'redirect_uri='.'http://voleur.testing.com/tab/requestes.php&'.'code='.$response['code'];
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/x-www-form-urlencoded",
    ]);
    $answer = curl_exec($ch);
    curl_close($ch);
    print_r($answer);

}

?>