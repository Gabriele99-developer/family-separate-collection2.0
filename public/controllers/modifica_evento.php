
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

if(isset($_POST['mod_id'])&&(is_numeric($_POST['mod_id'])))
 {
   while($fetch=mysqli_fetch_array($result)){

    $id = $_POST['mod_id'];
    $types_g = addslashes($_POST['types_garbageid']);
    $time = addslashes($_POST['time']);
    $str_data =date('Y-m-d',strtotime(str_replace('/','-',$_POST['date'])));
   }


  $sql = "UPDATE time SET date='$str_data', time='$time', types_garbageid='$types_g' where timeid= '$id'";
 
  if(mysqli_query($conn,$sql) or die (mysqli_error($conn)))
  {
    echo "Modifica effettuata con successo.<br>
    Vai al <a href=\"../views/vista_calendario.php\">Calendario</a>";
  }
}
elseif (isset($_GET['id']) && is_numeric($_GET['id']))
{
  $id2= $_GET['id'];
  $query = mysqli_query($conn, "SELECT types_garbageid,time,date FROM time WHERE timeid = $id2") or die (mysqli_error($conn));
  $fetch = mysqli_fetch_array($query)or die (mysqli_error($conn));
  $types_g = stripslashes($fetch['types_garbageid']);
  $time = stripslashes($fetch['time']);
  $str_data = date($fetch['date']); 
  ?>



  <?php
}
}
?>