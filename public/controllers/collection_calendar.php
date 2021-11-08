<?php
  session_start();
  $userIdCalendar= $_SESSION["id"];

  include('../models/database.php');

{   
  $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

    $query= "SELECT
    users.username,
    types_garbage.types_garbage,
    time.date, time.time, time.id
    FROM users
    INNER JOIN time
    ON users.id= time.id_users
    INNER JOIN types_garbage
    ON types_garbage.id= time.id_types_garbage
    WHERE users.id= $userIdCalendar";

  $result= $conn->query($query);

  if(mysqli_num_rows($result) > 0) {
    while($events_calendar = mysqli_fetch_array($result)) {   
      $Date = DateTime::createFromFormat('Y-m-d', $events_calendar[2]);
      $newDate = $Date->format('d-m-Y');
      $newTime = substr($events_calendar[3],0,5);
    }
  }
}
function ShowCalendar($m,$y)
{
  if ((!isset($_GET['d']))||($_GET['d'] == ""))
  {
    $m = date('n');
    $y = date('Y');
  }
  else
  {
    $m = (int)strftime( "%m" ,(int)$_GET['d']);
    $y = (int)strftime( "%Y" ,(int)$_GET['d']);
    $m = $m;
    $y = $y;
  }
  $previous = mktime(0, 0, 0, $m -1, 1, $y);
  $following = mktime(0, 0, 0, $m +1, 1, $y);
  $names_months = array(
    "Gen",
    "Feb",
    "Mar",
    "Apr",
    "Mag",
    "Giu", 
    "Lug",
    "Ago",
    "Set",
    "Ott",
    "Nov",
    "Dic"
  );
  $names_days = array(
    "Lun",
    "Mar",
    "Mer",
    "Gio",
    "Ven",
    "Sab",
    "Dom"
  );
  $cols = 7;
  $days = date("t",mktime(0, 0, 0, $m, 1, $y)); 
  $monday= date("w",mktime(0, 0, 0, $m, 1, $y));
  if($monday==0) $monday = 7;
  echo "<table>\n"; 
  echo "<tr>\n
  <td colspan=\"".$cols."\">
  <a href=\"?d=" . $previous . "\">&lt;&lt;</a>
  " . $names_months[$m-1] . " " . $y . " 
  <a href=\"?d=" . $following . "\">&gt;&gt;</a></td></tr>";

  foreach($names_days as $v){
      echo "<td><b>".$v."</b></td>\n";
    }
  echo "</tr>";

  for($j = 1; $j<$days+$monday; $j++){
      if($j%$cols+1==0)
      {
        echo "<tr>\n";
      }

    if($j<$monday)
      {
        echo "<td> </td>\n";
      }
    else{
      $day= $j-($monday-1);
      $date = strtotime(date($y."-".$m."-".$day));
      $today = strtotime(date("Y-m-d"));
      include ('../models/database.php');

      $userIdCalendar= $_SESSION["id"];

      $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
      $query2 = "SELECT date FROM time where time.id_users=$userIdCalendar";

      $result= $conn->query($query2);

    if(mysqli_num_rows($result) > 0) {
        while($fetch = mysqli_fetch_array($result)){
          $str_date = $fetch['date'];

          if (strtotime($str_date) == $date){  
            $day = "<a href=\"../views/event_view.php?day=$str_date\"><span style='color:green'>$day</span></a>";          
          }
        }
    }

if($date != $today){
    echo "<td>".$day."</td>";
  }
else{
          echo "<td><span style='color:red'><b>".$day."</b></span></td>";
        }
  }

    if($j%$cols==0)
      {
        echo "</tr>";
      }
  }
  echo "<tr></tr>";
  echo "</table>";
}
ShowCalendar(date("m"),date("Y")); 
$t=time();
$collection_day = date("Y-m-d",$t);
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
      echo "Raccolta <b> $types </b><br>" . $time . "<br>";
    }
  } 
  else {
    echo ("Nessun evento in programma per la giornata di oggi!");
  }
?>

