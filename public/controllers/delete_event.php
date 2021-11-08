<?php
session_start();
$userIdCalendar= $_SESSION["id"];
include('../models/database.php');
$del_id = $_GET["id"];
{   
    $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
      $sql = "SELECT
      users.username,
      types_garbage.types_garbage,
      time.date, time.time, time.id
      FROM users
      INNER JOIN time
      ON users.id= time.id_users
      INNER JOIN types_garbage
      ON types_garbage.id= time.id_types_garbage
      WHERE time.id = '$del_id'";  
   $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));
   if (isset($_GET["id"]) && is_numeric($_GET["id"])  )
  {
    if ($del_id != null)
      while($fetch = mysqli_fetch_array($result)){  
        $del_id = $_GET["id"];
        $types = $fetch['types_garbage'];
        $str_date = date($fetch['date']); 
      }
      ?>
      <?php
  }
  elseif(isset($_POST['del_id']) && is_numeric($_POST['del_id']))
  {
      $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
      $del_id2 = $_POST['del_id'];
      if (mysqli_query($conn, "DELETE FROM time WHERE id = '$del_id2'")or die(mysqli_error($conn)))
        {
          echo "Cancellazione del servizio avvenuta con successo<br>
          <a href=\"calendar_view.php\">Torna al calendario</a>";
        }
    
    header("Location:../views/calendar_view.php");
  }
}
?>
