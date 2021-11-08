<!DOCTYPE html>
<html>
  <header>
    <title>Modifica Evento</title>
  </header>
  <body style="background-image:URL('../img/collection.jpg'); background-repeat: no-repeat; background-position: center top;">
    <h1> Legenda: </h1>
    <ol>
      <li style= "color: #0000ff; font-size:20px;">Plastica</li>
      <li style= "color: #007fff; font-size:20px;">Vetro</li>
      <li style= "color: #e5be01; font-size:20px;">Carta</li>
      <li style= "color: #008f39; font-size:20px;">Umido</li>
      <li style= "color: #000000; font-size:20px;">Secco</li>
    </ol>
    <?php include('../controllers/modification_event.php');?>
      <h3>Modifica Evento Corrente</h3>
      <form name="tipo" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">Inserisci tipologia rifiuto:<br>
      <input type="text" name="id_types_garbage" value="<?php echo $types_g; ?>"> 
      <br>Inserisci ora:<br>
      <input type="text" name="time" value="<?php echo $time; ?>"> 
      <br>Inserisci data:<br>
      <input type="text" name="date" value="<?php echo $str_date; ?>">
      <br>
      <input type="hidden" name="mod_id" value="<?php echo $id2; ?>"> <br>
      <input type="submit" name="submit" value="modifica">
  </body>
</html>
