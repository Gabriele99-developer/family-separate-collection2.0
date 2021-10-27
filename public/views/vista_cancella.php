<html>
    <?php include('../controllers/cancella_evento.php');?>
<meta content="text/html; charset=UTF-8" http-equiv="content-type">
<head>
<title>Elimina Evento</title>
</head>
<body style="background-image:URL('../img/raccolta.jpg'); background-repeat: no-repeat; background-position: center -50%;">
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
</body>
