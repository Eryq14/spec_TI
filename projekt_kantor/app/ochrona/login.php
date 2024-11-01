<?php
session_start(); // Rozpoczęcie sesji

// Ustawienie zmiennych do komunikatów
$login_error = "";

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sprawdzenie poprawności loginu i hasła
    if ($username === 'Admin' && $password === 'Admin') {
        $_SESSION['loggedin'] = true; // Ustawienie sesji
        header('Location: ../currency_view.php'); // Przekierowanie do kantoru
        exit;
    } else {
        $login_error = "Błędny login lub hasło"; // Komunikat o błędzie
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Logowanie</title>
    <style>
        .error { color: red; border: 1px solid red; padding: 10px; }
    </style>
</head>
<body>
    <h2>Logowanie</h2>
    <form action="login.php" method="post">
        <label for="username">Login:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Hasło:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <input type="submit" value="Zaloguj">
    </form>

    <?php if ($login_error) { ?>
        <div class="error"><?php echo $login_error; ?></div>
    <?php } ?>
</body>
</html>
