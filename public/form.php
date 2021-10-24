<html>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<title>Inserisci Evento</title>
</head>
<body style="background-image:URL('raccolta.jpg'); background-repeat: no-repeat; background-position: center -50%;">
<h1> Legenda: </h1>

<ol>
	<li style= "color: #0000ff; font-size:20px;" >Plastica</li>
	<li style= "color: #007fff; font-size:20px;">Vetro</li>
	<li style= "color: #e5be01; font-size:20px;">Carta</li>
  <li style= "color: #008f39; font-size:20px;">Umido</li>
	<li style= "color: #000000; font-size:20px;">Secco</li>
</ol>
</body>
<?php
session_start();
$userIdCalendar= $_SESSION["userid"];


$DBHOST = "127.0.0.1:3306";
$DBUSER = "root";
$DBPASS = "SHA123";
$DBNAME = "collectiondb";

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
    Vai al <a href=\"calendario_raccolta.php\">Calendario</a>";
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
</html>