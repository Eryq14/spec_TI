<?php
require_once dirname(__FILE__).'/../config.php';

$messages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $amount = filter_input(INPUT_POST, 'amount');
    $rate = filter_input(INPUT_POST, 'rate');
    $conversion_type = filter_input(INPUT_POST, 'conversion_type');


    if ($amount === null || $amount === false || $amount === "") {
        $messages[] = 'Nie podano kwoty lub jest ona nieprawidłowa.';
    }
    if ($rate === null || $rate === false || $rate === "") {
        $messages[] = 'Nie podano kursu lub jest on nieprawidłowy.';
    }
    if (empty($conversion_type)) {
        $messages[] = 'Nie wybrano rodzaju przeliczenia.';
    }


    if (empty($messages)) {
        $amount = floatval($amount);
        $rate = floatval($rate);

        if ($conversion_type == 'eur_to_pln') {
            $result = $amount * $rate;  
        } elseif ($conversion_type == 'pln_to_eur') {
            $result = $amount / $rate;  
        }
    }
} else {
    $messages[] = 'Błędne wywołanie formularza. Wymagane jest wysłanie metodą POST.';
}


include _ROOT_PATH.'/app/currency_view.php';
