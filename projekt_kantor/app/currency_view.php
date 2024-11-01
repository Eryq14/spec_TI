<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Rozpoczęcie sesji
}

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /projekt_kantor/app/ochrona/login.php'); // Przekierowanie do logowania
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Kantor Walutowy</title>
    <style>
        .error { color: red; border: 1px solid red; padding: 10px; }
    </style>
</head>
<body>
    <h2>Kantor Walutowy</h2>
    <a href="ochrona/logout.php">Wyloguj</a> <!-- Link do wylogowania -->

  
    <form action="currency.php" method="post">
        <label for="amount">Kwota:</label>
        <input type="text" name="amount" id="amount" required>
        <br>
        <label for="rate">Kurs:</label>
        <input type="text" name="rate" id="rate" required>
        <br>
        <input type="radio" name="conversion_type" value="euro_to_pln" checked> Z Euro na PLN
        <input type="radio" name="conversion_type" value="pln_to_euro"> Z PLN na Euro
        <br>
        <input type="submit" value="Przelicz">
    </form>

    <?php if (!empty($result)) { ?>
        <div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
            <?php echo 'Wynik: ' . $result; ?>
        </div>
    <?php } ?>
</body>
</html>
