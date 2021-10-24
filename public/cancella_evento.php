<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<title>Elimina Evento</title>
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
$del_id = $_GET["id"];



{   
  $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
  
  

  $sql = "SELECT
  users.username,
  types_garbage.types_garbage,
  time.date, time.time, time.timeid
  FROM users
  INNER JOIN time
  ON users.usersid= time.usersid
  INNER JOIN types_garbage
  ON types_garbage.types_garbageid= time.types_garbageid
  WHERE time.timeid = '$del_id'";
  
  
$result = mysqli_query($conn, $sql) or die (mysqli_error($conn));


if (isset($_GET["id"]) && is_numeric($_GET["id"])  )
{
  if ($del_id != null)
  while($fetch = mysqli_fetch_array($result)){  

  $del_id = $_GET["id"];
  $types = $fetch['types_garbage'];
  $str_data = date($fetch['date']); 

  }

  ?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<h1>Attenzione!</h1>
Si sta per eliminare l'appuntamento del
<b><?php echo stripslashes($str_data); ?></b> 
raccolta<b> <?php echo stripslashes($types); ?>.</b><br>
Confermare per eseguire l'operazione.<br>
<br>
<input name="del_id" type="hidden" value="<?php echo $del_id; ?>">
<input name="submit" type="submit" value="Cancella">
</form>

  <?php
}
elseif(isset($_POST['del_id']) && is_numeric($_POST['del_id']))
{

  $conn = mysqli_connect($DBHOST, $DBUSER, $DBPASS, $DBNAME);
  $del_id2 = $_POST['del_id'];
  if (mysqli_query($conn, "DELETE FROM time WHERE timeid = '$del_id2'")or die(mysqli_error($conn)))
  {
    echo "Cancellazione del servizio avvenuta con successo<br>
    <a href=\"calendario_raccolta.php\">Torna al calendario</a>";
  }
 
  header("Location:calendario_raccolta.php");
}
}
?>
</html>