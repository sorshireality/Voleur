<?php
include_once "Helper.php";
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    $temp = Helper::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');
    $token_info = Helper::get_token($temp,$code);
    $arr = Helper::gettoken($token_info[0]['access_token']);
    echo json_encode($arr,JSON_PRETTY_PRINT);
    return true;
} else return false;