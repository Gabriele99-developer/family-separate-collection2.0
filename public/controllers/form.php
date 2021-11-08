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
        if (isset($_POST['submit']) && $_POST['submit']=="invia")
    {
        {
              $types_g = addslashes($_POST['id_types_garbage']);
              $time = addslashes($_POST['time']);
              $str_date =date('Y-m-d',strtotime(str_replace('/','-',$_POST['date'])));
        }
          $sql = "INSERT INTO time (id_types_garbage,time,date,id_users) VALUES ('$types_g', '$time ', '$str_date','$userIdCalendar')";
          $result = mysqli_query($conn ,$sql) or die (mysqli_error($conn));
          if($result)
          {
            echo "Inserimento avvenuto con successo.<br>
            Vai al <a href=\"calendar_view.php\">Calendario</a>";
          }
    }
    else
    {
        ?>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      Tipo di pattumiera:<br>
      <input name="id_types_garbage" type="text"><br>
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
