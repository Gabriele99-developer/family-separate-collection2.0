<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<title>Evento</title>
</head>
<body style="background-image:URL('raccolta.jpg'); background-repeat: no-repeat; background-position: center -50%;">
</body>
<?php

session_start();
$userIdCalendar= $_SESSION["userid"];

$DBHOST = "127.0.0.1:3306";
$DBUSER = "root";
$DBPASS = "SHA123";
$DBNAME = "collectiondb";
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
    echo "Raccolta <b> $types </b><br>" . $time . "<br>
    <a href=\"cancella_evento.php?id=$del_id\">Cancella</a> |
    <a href=\"modifica_evento.php?id=$del_id\">Modifica</a>
    <hr>";
    
  }

}

}
?>
</html>