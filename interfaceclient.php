<?php
session_start();
if (!isset($_SESSION['type_user']) || $_SESSION['type_user'] != 'client') {
    header("Location: services.php");

    /* session_start();
session_destroy();
header("Location: login.php");
exit() */
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<li><a href="vols.php">Vols</a></li>
<li><a href="bateaux.php">Bateaux</a></li>
<li><a href="hotel.php">Hotels</a> </li>
<li><a href="circuit.php">Circuits</a> </li>
<li><a href="voyage.php">voyages</a> </li>
<li><a href="contact.php">contact</a> </li>
</body>
</html>
