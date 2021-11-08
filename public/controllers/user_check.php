<?php
    include('../models/database.php');
    if(!empty($_POST) &&
    strlen(trim($_POST["username"]))!=0 &&
    strlen(trim($_POST["password"]))!=0 
    );
{
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
    $query = "SELECT * FROM users
    WHERE username = '".$_POST["username"]."'
    AND password='".$_POST["password"]."'";
    $result = $conn->query($query);
    if(mysqli_num_rows($result) > 0) {
        $idCalendarUser = mysqli_fetch_array($result);
        $userIdCalendar=$idCalendarUser[0];
        session_start();  
        $_SESSION["id"]= $userIdCalendar;   
    }
     else
        {
            $query = "INSERT INTO users (username,password)
            VALUES('".$_POST["username"]."',
            '".$_POST["password"]."')";
            $conn->query($query);

            $query = "SELECT * FROM users
            WHERE username = '".$_POST["username"]."'
            AND password='".$_POST["password"]."'";
            $result = $conn->query($query);

            $idCalendarUser = mysqli_fetch_array($result);
            $userIdCalendar=$idCalendarUser[0];
            session_start();
            $_SESSION["id"]= $userIdCalendar;
        }
    header("Location:../views/calendar_view.php");
    exit();
}
?>




