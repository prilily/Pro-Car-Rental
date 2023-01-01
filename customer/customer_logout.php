<?php include'header.php';

//destroy session when user logs out.
session_start();
session_unset();
session_destroy();

header('Location: ../index.php');

?>

