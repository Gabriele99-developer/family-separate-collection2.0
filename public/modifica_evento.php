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
    Vai al <a href=\"calendario_raccolta.php\">Calendario</a>";
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

<html>
  <head>
    <title>Modifica Evento</title>
</head>
<body>
  <h3>Modifica Evento Corrente</h3>
  <form name="tipo" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">Inserisci tipologia rifiuto:<br>
  <input type="text" name="types_garbageid" value="<?php echo $types_g; ?>"> 
  <br>Inserisci ora:<br>
  <input type="text" name="time" value="<?php echo $time; ?>"> 
  <br>Inserisci data:<br>
  <input type="text" name="date" value="<?php echo $str_data; ?>">
  <br>
  <input type="hidden" name="mod_id" value="<?php echo $id2; ?>"> <br>
  <input type="submit" name="submit" value="modifica">
 </body>


  <?php
}
}
?>