<?php
session_start();
$userIdCalendar= $_SESSION["id"];
include('../models/database.php');
$collection_day = $_GET['day'];
{   
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
      $sql = "SELECT
      users.username,
      types_garbage.types_garbage,
      time.date, time.time, time.id,time.id_types_garbage
      FROM users
      INNER JOIN time
      ON users.id= time.id_users
      INNER JOIN types_garbage
      ON types_garbage.id= time.id_types_garbage
      WHERE users.id= '$userIdCalendar'
      AND time.date= '$collection_day'";

    $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    if(mysqli_num_rows($result) > 0) { 
        while($fetch = mysqli_fetch_array($result)){   
            $del_id = $fetch['id'];
            $types_g = $fetch['id_types_garbage'];
            $types = stripslashes($fetch['types_garbage']);
            $time = stripslashes($fetch['time']);
            $str_date = date($fetch['date']); 
            $time = substr( $time, 0, 5 );
            echo "Raccolta <b> $types </b><br>" . $time . "<br>
            <a href=\"../views/delete_view.php?id=$del_id\">Cancella</a> |
            <a href=\"../views/modification_view.php?id=$del_id\">Modifica</a>
            <hr>"; 
        }
    }
}
?>
