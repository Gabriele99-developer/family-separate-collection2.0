<?php
$DBHOST = "127.0.0.1:3306";
$DBUSER = "root";
$DBPASS = "SHA123";
$DBNAME = "collectiondb";
$con = @mysqli_connect($DBHOST,$DBUSER,$DBPASS) or die (mysql_error());
?>