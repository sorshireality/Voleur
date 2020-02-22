<?php
include_once "Helper.php";
if (isset($_GET['code'])) {
    $temp = Helper::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');
    $arr = Helper::get_token($temp,'test_code');
    echo json_encode($arr);
    return true;
} else return false;