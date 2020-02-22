<?php
include_once "Helper.php";
if (isset($_GET['code'])) {
    Helper::getcode($_GET['code']);
}
if (isset($_GET['token'])){
    Helper::gettoken($_GET['token']);
}