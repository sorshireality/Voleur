<meta charset="x-UTF-16LE-BOM"><?phpinclude_once "Helper.php";if (isset($_GET['code'])) {    $code = $_GET['code'];    $temp = Helper::connect_db('id12607894_admin_plus','RrTyYo2@pL2@k!');    $token_info = Helper::get_token($temp,$code);    $arr = Helper::get_donations($token_info['access_token']);    Helper::close_connection($temp);    echo json_encode($arr,JSON_PRETTY_PRINT);    return true;} else return false;