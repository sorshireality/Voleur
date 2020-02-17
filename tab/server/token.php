<?php
include_once 'Helper.php';
if (isset($_GET['token'])){
    $token = $_GET['token'];
    $url = 'https://www.donationalerts.com/api/v1/alerts/donations';
    $response = Helper::get($url,$token);
    print_r($response);
    Helper::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');
    exit;

    if ($response[0] == 200){
        ?>
        <script>window.close();</script>
        <?php
    }}

?>