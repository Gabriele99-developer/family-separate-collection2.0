<html>
<head>
    <title>Modifica Evento</title>
</head>
<body style="background-image:URL('../img/raccolta.jpg'); background-repeat: no-repeat; background-position: center -50%;">
<h1> Legenda: </h1>

<ol>
	<li style= "color: #0000ff; font-size:20px;" >Plastica</li>
	<li style= "color: #007fff; font-size:20px;">Vetro</li>
	<li style= "color: #e5be01; font-size:20px;">Carta</li>
  <li style= "color: #008f39; font-size:20px;">Umido</li>
	<li style= "color: #000000; font-size:20px;">Secco</li>
</ol>



<?php include('../controllers/modifica_evento.php');?>



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
