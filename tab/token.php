<?php
include_once 'Helper.php';
if (isset($_GET['token'])){
    $token = $_GET['token'];
    $url = 'https://www.donationalerts.com/api/v1/alerts/donations';
    print_r(Helper::get($url,$token));
}
if (isset($_GET['code'])) {
$arr["suc"] = $_GET;
echo json_encode($arr);
return true;
} else return false;
?>