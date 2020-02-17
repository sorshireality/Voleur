<?php
include_once 'Helper.php';
if (isset($_GET['code'])){
    $result = Helper::post('https://www.donationalerts.com/oauth/token',402,'nUFC2TP8nzx1BDHuV2N7qulZDvoAwz2vSh3fuf3T','https://voleur.000webhostapp.com/tab/server/requestes.php',$_GET['code']);
    if ($result[0] == 200) {
    ?></body>: <script> setTimeout(function() { window.location = "token.php?token=<?php echo $result['access_token']; ?>"; }, 500); </script><?php
} else {echo "Error while get aceess code : message -> "; print_r($result);exit;}
    }
?>