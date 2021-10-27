<?php

session_start();
$userIdCalendar= $_SESSION["userid"];

include('../models/database.php');

{   
$conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);

$query= "SELECT
users.username,
types_garbage.types_garbage,
time.date, time.time, time.timeid
FROM users
INNER JOIN time
ON users.usersid= time.usersid
INNER JOIN types_garbage
ON types_garbage.types_garbageid= time.types_garbageid
WHERE users.usersid= $userIdCalendar";

$result= $conn->query($query);

if(mysqli_num_rows($result) > 0) {



  while($Calendario_eventi = mysqli_fetch_array($result)) {   
  $Date = DateTime::createFromFormat('Y-m-d', $Calendario_eventi[2]);
  $newDate = $Date->format('d-m-Y');
  $newTime = substr($Calendario_eventi[3],0,5);
  }

}

}
?>


<?php
function ShowCalendar($m,$y)
{
  if ((!isset($_GET['d']))||($_GET['d'] == ""))
  {
    $m = date('n');
    $y = date('Y');
  }else{
    $m = (int)strftime( "%m" ,(int)$_GET['d']);
    $y = (int)strftime( "%Y" ,(int)$_GET['d']);
    $m = $m;
    $y = $y;
  }

  $precedente = mktime(0, 0, 0, $m -1, 1, $y);
  $successivo = mktime(0, 0, 0, $m +1, 1, $y);

  $nomi_mesi = array(
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
  $nomi_giorni = array(
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
  $lunedi= date("w",mktime(0, 0, 0, $m, 1, $y));
  if($lunedi==0) $lunedi = 7;
  echo "<table>\n"; 
  echo "<tr>\n
  <td colspan=\"".$cols."\">
  <a href=\"?d=" . $precedente . "\">&lt;&lt;</a>
  " . $nomi_mesi[$m-1] . " " . $y . " 
  <a href=\"?d=" . $successivo . "\">&gt;&gt;</a></td></tr>";
  foreach($nomi_giorni as $v)
  {
    echo "<td><b>".$v."</b></td>\n";
  }
  echo "</tr>";

  for($j = 1; $j<$days+$lunedi; $j++)
  {
    if($j%$cols+1==0)
    {
      echo "<tr>\n";
    }

    if($j<$lunedi)
    {
      echo "<td> </td>\n";
    }else{
      $day= $j-($lunedi-1);
      $data = strtotime(date($y."-".$m."-".$day));
      $oggi = strtotime(date("Y-m-d"));
      include ('../models/database.php');
      
      
      $userIdCalendar= $_SESSION["userid"];

      $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
      $query2 = "SELECT date FROM time where usersid=$userIdCalendar";

     
      
      $result= $conn->query($query2);



if(mysqli_num_rows($result) > 0) {

        while($fetch = mysqli_fetch_array($result))
        {
          
          $str_data = $fetch['date'];
 
          if (strtotime($str_data) == $data){  
          
           
            $day = "<a href=\"../views/vista_eventi.php?day=$str_data\"><span style='color:green'>$day</span></a>";
            
          }
        }
      }

      if($data != $oggi)
      {
        echo "<td>".$day."</td>";
      }else{
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

$giorno_di_raccolta = date("Y-m-d",$t);
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
    echo "Raccolta <b> $types </b><br>" . $time . "<br>";
  
    
  }

} else {
  echo ("Nessun evento in programma per la giornata di oggi!");
}




?>

