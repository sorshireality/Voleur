<?php
namespace plug;
include_once "Voleur.php";

$test_object = new Voleur();
print_r($test_object->send_request());

?>