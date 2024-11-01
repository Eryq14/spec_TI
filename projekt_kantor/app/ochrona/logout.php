<?php
session_start(); // Rozpoczęcie sesji
session_destroy(); // Zniszczenie sesji
header('Location: /projekt_kantor/app/ochrona/login.php'); // Przekierowanie do logowania
exit;
?>

