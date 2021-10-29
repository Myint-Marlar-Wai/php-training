<?php
 $dbhost = "localhost:3306";
 $dbuser = "root";
 $dbpass = "root";
 $dbname = "store";
 $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
 mysqli_select_db($conn, $dbname);
?>
