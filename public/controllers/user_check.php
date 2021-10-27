<?php

$DBHOST = "127.0.0.1:3306";
$DBUSER = "root";
$DBPASS = "SHA123";
$DBNAME = "collectiondb";


if(!empty($_POST) &&
strlen(trim($_POST["username"]))!=0 &&
strlen(trim($_POST["password"]))!=0 
);{


$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

$query = "SELECT * FROM users
WHERE username = '".$_POST["username"]."'
AND password='".$_POST["password"]."'";

$result = $conn->query($query);

if(mysqli_num_rows($result) > 0) {
    $idCalendarioUser = mysqli_fetch_array($result);
    $userIdCalendar=$idCalendarioUser[0];
    
    session_start();  
    $_SESSION["userid"]= $userIdCalendar;
    
}
else{
    $query = "INSERT INTO users (username,password)
    VALUES('".$_POST["username"]."',
    '".$_POST["password"]."')";
    $conn->query($query);

    $query = "SELECT * FROM users
    WHERE username = '".$_POST["username"]."'
    AND password='".$_POST["password"]."'";
    $result = $conn->query($query);

    $idCalendarioUser = mysqli_fetch_array($result);
    $userIdCalendar=$idCalendarioUser[0];
    session_start();
    $_SESSION["userid"]= $userIdCalendar;
}


header("Location:../views/vista_calendario.php");
exit();

}

?>




