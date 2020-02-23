<?php
 if (isset($_GET['permission'])) {
 	if ($_GET['permission'] == 'none') {
 		echo "You dont have access to that directory";
 	} 
 } else {
 	echo "You try to access file with no permission";
 }

?>