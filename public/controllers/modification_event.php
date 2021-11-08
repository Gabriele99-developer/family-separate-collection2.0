<?php
session_start();
$userIdCalendar= $_SESSION["id"];
include('../models/database.php');
{   
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);   
      $sql = "SELECT
      users.username,
      types_garbage.types_garbage,
      time.date, time.time, time.id, time.id_types_garbage
      FROM users
      INNER JOIN time
      ON users.id= time.id_users
      INNER JOIN types_garbage
      ON types_garbage.id= time.id_types_garbage
      WHERE users.id= '$userIdCalendar'";
      $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
      if(isset($_POST['mod_id'])&&(is_numeric($_POST['mod_id'])))
        {
          while($fetch=mysqli_fetch_array($result)){
              $id = $_POST['mod_id'];
              $types_g = addslashes($_POST['id_types_garbage']);
              $time = addslashes($_POST['time']);
              $str_date =date('Y-m-d',strtotime(str_replace('/','-',$_POST['date'])));
          }
          $sql = "UPDATE time SET date='$str_date', time='$time', id_types_garbage='$types_g' where id= '$id'";
          if(mysqli_query($conn,$sql) or die (mysqli_error($conn)))
          {
              echo "Modifica effettuata con successo.<br>
              Vai al <a href=\"../views/calendar_view.php\">Calendario</a>";
          }
        }
  elseif (isset($_GET['id']) && is_numeric($_GET['id']))
  {
    $id2= $_GET['id'];
    $query = mysqli_query($conn, "SELECT id_types_garbage,time,date FROM time WHERE id= $id2") or die (mysqli_error($conn));
    $fetch = mysqli_fetch_array($query)or die (mysqli_error($conn));
    $types_g = stripslashes($fetch['id_types_garbage']);
    $time = stripslashes($fetch['time']);
    $str_date = date($fetch['date']); 
    ?>
    <?php
  }
}
?>