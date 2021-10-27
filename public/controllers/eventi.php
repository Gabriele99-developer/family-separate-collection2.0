<?php

session_start();
$userIdCalendar= $_SESSION["userid"];

include('../models/database.php');
$giorno_di_raccolta = $_GET['day'];

{   
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

$sql = "SELECT
users.username,
types_garbage.types_garbage,
time.date, time.time, time.timeid,time.types_garbageid
FROM users
INNER JOIN time
ON users.usersid= time.usersid
INNER JOIN types_garbage
ON types_garbage.types_garbageid= time.types_garbageid
WHERE users.usersid= '$userIdCalendar'
AND time.date= '$giorno_di_raccolta'";

$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
if(mysqli_num_rows($result) > 0) {
  

  while($fetch = mysqli_fetch_array($result)){   

    $del_id = $fetch['timeid'];
    $types_g = $fetch['types_garbageid'];
    $types = stripslashes($fetch['types_garbage']);
    $time = stripslashes($fetch['time']);
    $str_data = date($fetch['date']); 
    $time = substr( $time, 0, 5 );
    echo "Raccolta <b> $types </b><br>" . $time . "<br>
    <a href=\"../views/vista_cancella.php?id=$del_id\">Cancella</a> |
    <a href=\"../views/vista_modifica.php?id=$del_id\">Modifica</a>
    <hr>";
    
  }

}

}
?>
