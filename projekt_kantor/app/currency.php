<?php
session_start(); // Rozpoczęcie sesji
require_once dirname(__FILE__) . '/../config.php'; 

// Sprawdzenie, czy użytkownik jest zalogowany
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: /projekt_kantor/app/ochrona/login.php');
    exit;
}


if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Błędne wywołanie formularza. Wymagane jest wysłanie metodą POST.");
}

// Pobranie parametrów z formularza
$amount = $_POST['amount'];
$rate = $_POST['rate'];
$conversion_type = $_POST['conversion_type'];
$result = "";

// Walidacja danych
if (!is_numeric($amount) || !is_numeric($rate)) {
    die("Kwota i kurs muszą być liczbami.");
}

// Wykonanie konwersji
if ($conversion_type === 'euro_to_pln') {
    $result = $amount * $rate; 
} elseif ($conversion_type === 'pln_to_euro') {
    $result = $amount / $rate; 
}

// Wywołanie widoku
include _ROOT_PATH . '/app/currency_view.php';
?>

