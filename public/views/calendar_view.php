<!DOCTYPE html>
<html>
  <meta content="text/html; charset=UTF-8" http-equiv="content-type">
  <header>
    <title>Calendario Raccolta</title>
  </header>
  <body style="background-image:URL('../img/collection.jpg'); background-repeat: no-repeat; background-position: center top;">
    <h1> Calendario </h1>
    <a href= "../controllers/logout.php" style="color:red; font-size:20px;"> <b>Logout<b> </a><br> 
    <br>
    <a href= "form_view.php" style="color:green; font-size:20px;"> Inserisci evento </a>
    <br>
    <br>
    <?php include('../controllers/collection_calendar.php');?>
    <h2> Legenda: </h2>
    <ol>
      <li style= "color: #0000ff; font-size:20px;">Plastica</li>
      <li style= "color: #007fff; font-size:20px;">Vetro</li>
      <li style= "color: #e5be01; font-size:20px;">Carta</li>
      <li style= "color: #008f39; font-size:20px;">Umido</li>
      <li style= "color: #000000; font-size:20px;">Secco</li>
    </ol>
  </body>
</html>