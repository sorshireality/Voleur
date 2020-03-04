<?php

include_once "Helper.php";

if (isset($_GET['name']))
print_r(json_encode($_GET['name']));