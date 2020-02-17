<?php
if (isset($_GET['code'])) {
$arr["suc"] = $_GET;
echo json_encode($arr);
return true;
} else return false;