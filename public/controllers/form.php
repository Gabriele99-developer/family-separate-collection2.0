<?php
session_start();
$userIdCalendar= $_SESSION["userid"];


include('../models/database.php');

{   
  $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
  
  $sql = "SELECT
  users.username,
  types_garbage.types_garbage,
  time.date, time.time, time.timeid, time.types_garbageid
  FROM users
  INNER JOIN time
  ON users.usersid= time.usersid
  INNER JOIN types_garbage
  ON types_garbage.types_garbageid= time.types_garbageid
  WHERE users.usersid= '$userIdCalendar'";
  
  
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

if (isset($_POST['submit']) && $_POST['submit']=="invia")
{
 {

  $types_g = addslashes($_POST['types_garbageid']);
    $time = addslashes($_POST['time']);
  $str_data =date('Y-m-d',strtotime(str_replace('/','-',$_POST['date'])));

  }

  $sql = "INSERT INTO time (types_garbageid,time,date,usersid) VALUES ('$types_g', '$time ', '$str_data','$userIdCalendar')";

  $result = mysqli_query($conn ,$sql) or die (mysqli_error($conn));

  if($result)
  {
    echo "Inserimento avvenuto con successo.<br>
    Vai al <a href=\"vista_calendario.php\">Calendario</a>";
  }

}else{
  ?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
Tipo di pattumiera:<br>
<input name="types_garbageid" type="text"><br>
Ora:<br>
<input name="time" type="text"><br>
Data:<br>
<input name="date" type="text" value="Y-m-d"><br>
<br>
<input name="submit" type="submit" value="invia">
</form>
  <?php
}
}
?>
