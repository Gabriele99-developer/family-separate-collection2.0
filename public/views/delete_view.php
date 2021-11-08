<!DOCTYPE html>
<html>
    <?php include('../controllers/delete_event.php');?>
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <header>
       <title>Elimina Evento</title>
    </header>
    <body style="background-image:URL('../img/collection.jpg'); background-repeat: no-repeat; background-position: center top;">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Attenzione!</h1>
            Si sta per eliminare l'appuntamento del
            <b><?php echo stripslashes($str_date); ?></b> 
            raccolta<b> <?php echo stripslashes($types); ?>.</b><br>
            Confermare per eseguire l'operazione.<br>
            <br>
            <input name="del_id" type="hidden" value="<?php echo $del_id; ?>">
            <input name="submit" type="submit" value="Cancella">
        </form>
    </body>
</html>