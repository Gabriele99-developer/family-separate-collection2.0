<?php
session_start();

// elimina le variabili
$_SESSION["userid"] = array();

// elimina la sessione
session_destroy();

header("Location:index.php");

?>
